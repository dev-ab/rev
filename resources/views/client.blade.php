@extends('layouts/app')

@section('content')
<div class="container-fluid">
    <h3 style="text-align: center">Create New Client</h3>
    <div class='row'>
        <div class='col-md-6 col-md-offset-3'>
            @if(session('status') == 'nothing')
            <h5 class="alert alert-danger" style="text-align: center"> Something went wrong.</h5>
            @elseif(session('status') == 'created')
            <h5 class="alert alert-success" style="text-align: center">Client Created Successfully.</h5>
            @elseif(session('status') == 'deleted')
            <h5 class="alert alert-success" style="text-align: center">Client Deleted Successfully.</h5>
            @endif
        </div>
    </div>
    <div class='row'>
        <form method="post" action="{{url('client/save')}}">
            {{csrf_field()}}
            <input type="hidden" name="id" value="null">
            <div class='col-md-8 col-md-offset-2'>
                <!-- Nav tabs -->
                <ul id="myTabs" class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#basic" aria-controls="basic" role="tab" data-toggle="tab">Basic Info</a></li>
                    <li role="presentation"><a href="#contacts" aria-controls="contacts" role="tab" data-toggle="tab">Contacts</a></li>
                    <li role="presentation"><a href="#reps" aria-controls="reps" role="tab" data-toggle="tab">Representatives</a></li>
                    <li role="presentation"><a href="#parts" aria-controls="parts" role="tab" data-toggle="tab">Partners</a></li>
                    <li role="presentation"><a href="#fin" aria-controls="fin" role="tab" data-toggle="tab">Finances</a></li>
                    <li role="presentation"><a href="#att" aria-controls="att" role="tab" data-toggle="tab">Attachments</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="basic">
                        <h4 style="padding: 10px">Enter basic info below</h4>
                        <div class="row" style="padding: 10px">
                            <div class="col-md-6">
                                <input type="text" name="name" class="form-control" value="{{old('name')}}" placeholder="Client name / Organisation name">
                            </div>
                        </div>
                        <div class="row" style="padding: 10px">
                            <div class="col-md-4">
                                <select name="type" class="form-control">
                                    <option value="">Client / Organisation Type..</option>
                                    <option value="individual">Individual</option>
                                    <option value="limited">Limited</option>
                                    <option value="solidarity">Solidarity</option>
                                    <option value="contributor">Contributor</option>
                                </select>
                            </div>
                        </div>
                        <div class="row" style="padding: 10px">
                            <div class="col-md-6">
                                <input type="text" name="registeration" class="form-control" value="{{old('registration')}}" placeholder="Registration Number">
                            </div>
                        </div>
                        <div class="row" style="padding: 10px">
                            <div class="col-md-6">
                                <input type="text" name="registeration_date" class="form-control datepicker" value="{{old('registeration_date')}}" placeholder="Registration Expiry Date">
                            </div>
                        </div>
                        <div class="row" style="padding: 10px">
                            <div class="col-md-6">
                                <input type="text" name="activity" class="form-control" value="{{old('registration')}}" placeholder="Client / Organization Activity">
                            </div>
                        </div>
                        <div class="row" style="padding: 10px">
                            <div class="col-md-2 col-md-offset-6">
                                <a href='' onclick="return switchTab('contacts')" class="btn btn-info">Next</a>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="contacts">
                        <h4 style="padding: 10px">Enter Client / Organisation contacts below</h4>
                        <hr>
                        <div>
                            <h5>Client Addresses</h5>
                            @if(is_array(old('addresses')))
                            @foreach(old('addresses') as $index => $address)
                            <div class="row" style="padding: 10px">
                                <div class="col-md-6">
                                    <input type="text" name="addresses[]" class="form-control" value="{{$address}}" placeholder="Enter Address">
                                </div>
                                <div class="col-md-2">
                                    @if(!isset($add))
                                    <a id="addAddress" href="">Add Another</a>
                                    <?php $add = true; ?>
                                    @else
                                    <a id="delContact" href="">Remove</a>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                            @else
                            <div class="row" style="padding: 10px">
                                <div class="col-md-6">
                                    <input type="text" name="addresses[]" class="form-control" value="" placeholder="Enter Address">
                                </div>
                                <div class="col-md-2">
                                    <a id="addAddress" href="">Add Another</a>
                                </div>
                            </div>
                            @endif
                        </div>
                        <hr>
                        <div>
                            <h5>Email Addresses</h5>
                            @if(is_array(old('emails')))
                            @foreach(old('emails') as $index => $email)
                            <div class="row" style="padding: 10px">
                                <div class="col-md-6">
                                    <input type="text" name="emails[]" class="form-control" value="{{$email}}" placeholder="Enter Email Address">
                                </div>
                                <div class="col-md-2">
                                    @if(!isset($em))
                                    <a id="addEmail" href="">Add Another</a>
                                    <?php $em = true; ?>
                                    @else
                                    <a id="delContact" href="">Remove</a>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                            @else
                            <div class="row" style="padding: 10px">
                                <div class="col-md-6">
                                    <input type="text" name="emails[]" class="form-control" value="" placeholder="Enter Email Address">
                                </div>
                                <div class="col-md-2">
                                    <a id="addEmail" href="">Add Another</a>
                                </div>
                            </div>
                            @endif
                        </div>
                        <hr>
                        <div>
                            <h5>Phone Numbers</h5>
                            @if(is_array(old('phones')))
                            @foreach(old('phones') as $index => $phone)
                            <div class="row" style="padding: 10px">
                                <div class="col-md-6">
                                    <input type="text" name="phones[]" class="form-control" value="{{$phone}}" placeholder="Enter Phone Number">
                                </div>
                                <div class="col-md-2">
                                    @if(!isset($ph))
                                    <a id="addPhone" href="">Add Another</a>
                                    <?php $ph = true; ?>
                                    @else
                                    <a id="delContact" href="">Remove</a>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                            @else
                            <div class="row" style="padding: 10px">
                                <div class="col-md-6">
                                    <input type="text" name="phones[]" class="form-control" value="" placeholder="Enter Phone Number">
                                </div>
                                <div class="col-md-2">
                                    <a id="addPhone" href="">Add Another</a>
                                </div>
                            </div>
                            @endif
                        </div>
                        <hr>
                        <div>
                            <h5>Fax Numbers</h5>
                            @if(is_array(old('faxes')))
                            @foreach(old('faxes') as $index => $fax)
                            <div class="row" style="padding: 10px">
                                <div class="col-md-6">
                                    <input type="text" name="faxes[]" class="form-control" value="{{$fax}}" placeholder="Enter Fax Number">
                                </div>
                                <div class="col-md-2">
                                    @if(!isset($fx))
                                    <a id="addFax" href="">Add Another</a>
                                    <?php $fx = true; ?>
                                    @else
                                    <a id="delContact" href="">Remove</a>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                            @else
                            <div class="row" style="padding: 10px">
                                <div class="col-md-6">
                                    <input type="text" name="faxes[]" class="form-control" value="" placeholder="Enter Fax Number">
                                </div>
                                <div class="col-md-2">
                                    <a id="addFax" href="">Add Another</a>
                                </div>
                            </div>
                            @endif
                        </div>
                        <hr>
                        <div class="row" style="padding: 10px">
                            <div class="col-md-2">
                                <a href='' onclick="return switchTab('basic')" class="btn btn-info">Back</a>
                            </div>
                            <div class="col-md-2 col-md-offset-4">
                                <a href='' onclick="return switchTab('reps')" class="btn btn-info">Next</a>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="reps">
                        <h4 style="padding: 10px">Enter Client Representatives info below</h4>
                        <div>
                            <div class="row" style="padding: 10px">
                                <div class="col-md-6">
                                    <input type="text" name="reps" class="form-control" value="{{old('reps')}}" placeholder="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="parts">

                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="fin">

                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="att">
                        <div class="row" style="padding: 10px">
                            <div class="col-md-2 col-md-offset-8" style='text-align: center'>
                                <input type="submit" value="Save" class="btn btn-success">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <hr>

    <h3 style="text-align: center">Manage Existing Clients</h3>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Client Name</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clients as $client)
                    <tr>
                        <td>{{$client->id}}</td>
                        <td>{{$client->name}}</td>
                        <td style="text-align: center">
                            <a href="{{url('client/edit/' . $client->id)}}" style="margin-right: 20px">Edit</a>
                            <a href="{{url('client/delete/' . $client->id)}}" style="margin-right: 20px">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function () {
        //add address
        $('body').on('click', '#addAddress', function (e) {
            e.preventDefault();
            $(this).parent().parent().parent().append('<div class="row" style="padding: 10px"><div class="col-md-6"><input type="text" class="form-control" name="addresses[]" placeholder="Enter Address"></div><div class="col-md-2"><a id="delContact" href="">Remove</a></div></div>');
        });
        //add email
        $('body').on('click', '#addEmail', function (e) {
            e.preventDefault();
            $(this).parent().parent().parent().append('<div class="row" style="padding: 10px"><div class="col-md-6"><input type="text" class="form-control" name="emails[]" placeholder="Enter Email Address"></div><div class="col-md-2"><a id="delContact" href="">Remove</a></div></div>');
        });
        //add phone
        $('body').on('click', '#addPhone', function (e) {
            e.preventDefault();
            $(this).parent().parent().parent().append('<div class="row" style="padding: 10px"><div class="col-md-6"><input type="text" class="form-control" name="phones[]" placeholder="Enter Phone Number"></div><div class="col-md-2"><a id="delContact" href="">Remove</a></div></div>');
        });
        //add fax
        $('body').on('click', '#addFax', function (e) {
            e.preventDefault();
            $(this).parent().parent().parent().append('<div class="row" style="padding: 10px"><div class="col-md-6"><input type="text" class="form-control" name="faxes[]" placeholder="Enter Fax Number"></div><div class="col-md-2"><a id="delContact" href="">Remove</a></div></div>');
        });
        //remove contact
        $('body').on('click', '#delContact', function (e) {
            e.preventDefault();
            $(this).parent().parent().remove();
        });
    });

    function switchTab(id) {
        window.scrollTo(0, 0);
        $('#myTabs a[href="#' + id + '"]').tab('show');
        return false;
    }
</script>
@endsection