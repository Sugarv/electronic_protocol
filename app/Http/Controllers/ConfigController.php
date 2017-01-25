<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Config;
use App\Attachment;
use Carbon\Carbon;
use File;
use Storage;

class ConfigController extends Controller
{

	    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('web');
        $this->middleware('admin:home');
    }

    public function index(){
        $c =  new Config;
        $configs = $c->getConfigValues();
	    $fields = [
	        'fakelos' => 'Φάκελος',
	        'thema' => 'Θέμα',
	        'in_topos_ekdosis' => 'Τόπος έκδοσης',
	        'in_arxi_ekdosis' => 'Αρχή έκδοσης',
	        'in_paraliptis' => 'Παραλήπτης',
	        'diekperaiosi' => 'Διεκπεραίωση',
	        'in_perilipsi' => 'Περιλ. Εισερχ',
	        'out_to' => 'Απευθύνεται',
	        'out_perilipsi' => 'Περιλ. Εξερχ',
	        'keywords' => 'Λέξεις κλειδιά',
	        'paratiriseis' => 'Παρατηρήσεις'
	    ];


        return view('config', compact('configs','fields'));
    }

    public function store(){

    	$data = request()->all();


        $this->validate(request(), [
            'ipiresiasName' => 'required|max:255',
            'yearInUse' => 'sometimes|integer|digits:4',
            'firstProtocolNum' => 'required|integer',
            'showRowsInPage' => 'required|integer',
            'protocolArrowStep' => 'required|integer',
            'maxRowsInFindPage' => 'required|integer',
        ]);


        $config = new Config;
        foreach($data as $key => $value){
            $config->setConfigValueOf($key,$value);
        } 

        $notification = array(
            'message' => 'Επιτυχημένη καταχώριση.', 
            'alert-type' => 'success'
        );
        session()->flash('notification',$notification);

        return redirect("/config");
    }


    public function backups(){
        $f = File::files(storage_path('app/arxeio/backups/'));
        $files =[];
        foreach($f as $path){
            $files[] = pathinfo($path);
        }
        return view('backup', compact('files'));
    }

    public function backup(){
        $database = config('database.connections.mysql.database');
        $username = config('database.connections.mysql.username');
        $password = config('database.connections.mysql.password');
        $config = new Config;
        $mysqldumpPath = $config->getConfigValueOf('mysqldumpPath');

        if ('\\' === DIRECTORY_SEPARATOR) {
            $filename = storage_path('app/arxeio/backups') . "/$database\_back_" . date ( "YmdHms" ) . '.sql';
            $command = "$mysqldumpPath --user=$username --password=$password --host=localhost $database > $filename"
        }else{
            $filename = storage_path('app/arxeio/backups') . "/$database\_back_" . date ( "YmdHms" ) . '.sql.gz';
            $command = "$mysqldumpPath --user=$username --password=$password --host=localhost $database | gzip > $filename"
        }
        exec ( $command, $out, $ret);

        if($ret == 0){
            $notification = array(
                'message' => "Επιτυχημένη δημιουργία αρχείου backup.", 
                'alert-type' => 'success'
            );
        }else{
            $notification = array(
                'message' => "Πρόβλημα στη δημιουργία αρχείου backup.", 
                'alert-type' => 'error'
            );
        }
        session()->flash('notification',$notification);

        return back();
    }


    public function downloadBackup($name){
        $content = Storage::get('arxeio/backups//' . $name);
        return response($content)
            ->header('Content-Type', 'application\/x-gzip')
            ->header('Content-Disposition', "filename=" . $name);
    }

    public function deleteBackup ($name){
        Storage::delete('arxeio/backups//' . $name);
        return back();
   }

    public function arxeio(){
        $arxeianum = Attachment::where('expires', '<' , Carbon::now()->format('Ymd'))->count();
        return view('arxeio', compact('arxeianum'));
   }

    public function expired(){
        $arxeia = Attachment::whereNotNull('expires')->where('expires', '<' , Carbon::now()->format('Ymd'))->get();
        foreach($arxeia as $arxeio){
            if($arxeio->protocol->protocoldate) $arxeio->protocol->protocoldate = Carbon::createFromFormat('Ymd', $arxeio->protocol->protocoldate)->format('d/m/Y');
            if($arxeio->protocol->in_date) $arxeio->protocol->in_date = Carbon::createFromFormat('Ymd', $arxeio->protocol->in_date)->format('d/m/Y');
            if($arxeio->protocol->out_date) $arxeio->protocol->out_date = Carbon::createFromFormat('Ymd', $arxeio->protocol->out_date)->format('d/m/Y');
            if($arxeio->expires) $arxeio->expires = Carbon::createFromFormat('Ymd', $arxeio->expires)->format('d/m/Y');
        }

        $arxeia = $arxeia->sort(
                function ($a, $b) {
                    // sort by column1 first, then 2, and so on
                    return strcmp($a->protocol->fakelos, $b->protocol->fakelos)
                        ?: strcmp($a->protocol->protocolnum, $b->protocol->protocolnum)
                        ?: strcmp($a->id, $b->id);
                }
        );

        $config = new Config;
        $ipiresiasName = $config->getConfigValueOf('ipiresiasName');
        $datetime = Carbon::now()->format('d/m/Y H:m:s');
        return view('expired', compact('arxeia','ipiresiasName', 'datetime'));
    }

    public function delExpired(){
        $arxeianum = Attachment::where('expires', '<' , Carbon::now()->format('Ymd'))->count();
        $arxeia = Attachment::whereNotNull('expires')->where('expires', '<' , Carbon::now()->format('Ymd'))->get();
        foreach($arxeia as $arxeio){
            $savedPath = $arxeio->savedPath;
            Storage::delete($savedPath);
        }

        Attachment::whereNotNull('expires')->where('expires', '<' , Carbon::now()->format('Ymd'))->delete();

        $notification = array(
            'message' => "Διαγράφηκαν $arxeianum αρχεία.", 
            'alert-type' => 'success'
        );
        session()->flash('notification',$notification);

        return back();
    }

}
