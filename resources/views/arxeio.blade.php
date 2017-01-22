@extends('layouts.app')

@section('content')

<style>
.hideoverflow{
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
</style>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading h1 text-center">Εκκαθάριση αρχείου</div>

                <div class="panel-body ">
                    <div class="panel panel-default col-md-12 col-sm-12  ">
                        <div class="row bg-info">
                            <div class="form-control-static h4 text-center col-md-12 col-sm-12  " >
                              @if($arxeianum)
                              Βρέθηκαν {{$arxeianum}} έγγραφα προς εκκαθάριση
                              @else
                              Δεν υπάρχουν έγγραφα προς εκκαθάριση
                              @endif
                            </div>
                        </div>
                    </div>

                      <div class="row">
                          <div class="col-md-2 col-sm-2 col-md-offset-4 col-sm-offset-4 text-center">
                            @if($arxeianum)
                              <a href="{{ URL::to('/expired') }}"  target="_blank" role="button" title="Εκτύπωση" > <img src="{{ URL::to('/') }}/images/print.png" height="30" /></a>
                            @endif
                          </div>
                          <div class="col-md-2 col-sm-2 text-center ">
                            @if($arxeianum)
                              <a href="#"  onclick="chkdelete({{$arxeianum}})" role="button" title="Διαγραφή" > <img src="{{ URL::to('/') }}/images/delete.ico" height="25" /></a>
                            @endif
                          </div>
                          <div class="col-md-2 col-sm-2 col-md-offset-2 col-sm-offset-2 text-center ">
                              <a href="{{ URL::to('/home') }}"  class="" role="button" title="Πρωτόκολλο" > <img src="{{ URL::to('/') }}/images/protocol.png" height="30" /></a>
                          </div>
                      </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script>

function chkdelete(num){
 
    var html = "<center><button type='button' id='confirmationRevertYes' class='btn btn-primary'>Ναί</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type='button' id='confirmationRevertNo' class='btn btn-primary'>Όχι</button></center>"
    var msg = '<center><h4>Διαγραφή ?</h4><hr></center>Διαγραφή ' + num + ' αρχείων λόγω λήξης του ορίου διατήρησης.<br><br>ΠΡΟΣΟΧΗ!!!<br>Η λειτουργία δεν είναι αναστρέψιμη.<br><br>Είστε σίγουροι;<br>&nbsp;'
    
    toastr.options = {
      "closeButton": true,
      "debug": false,
      "newestOnTop": false,
      "progressBar": false,
      "positionClass": "toast-top-center",
      "preventDuplicates": false,
      "onclick": null,
      "showDuration": "0",
      "hideDuration": "0",
      "timeOut": "0",
      "extendedTimeOut": "0",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }
    var $toast = toastr.error(html,msg);
    $toast.delegate('#confirmationRevertYes', 'click', function () {
            $(location).attr('href', "{{ URL::to('/') }}" + "/delExpired/" + name)
            $toast.remove();
    });
    $toast.delegate('#confirmationRevertNo', 'click', function () {
            $toast.remove();
    });
}
</script>

@endsection