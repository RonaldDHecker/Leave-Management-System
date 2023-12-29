@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Data Tables</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                        <li class="breadcrumb-item active">Data Tables</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Compassionate Time-off</h4>
                    <p class="card-title-desc">
                    </p>

                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th style="text-align: center;">NAME OF EMPLOYEE: </th>
                            <th style="text-align: center;">OFFICE/DIVISION:</th>
                            <th style="text-align: center;">FROM: </th>
                            <th style="text-align: center;">TO: </th>
                            <th style="text-align: center;">REASON: </th>
                            <th style="text-align: center;">STATUS: </th>
                            <th style="text-align: center;">ACTION: </th>
                        </tr>
                        </thead>


                        <tbody>
                        @foreach ($compassionates as $compassionate)
                        <tr>
                            <td>{{ Str::ucfirst(strtolower($compassionate->user->firstname)) }}{{ " " }}{{ strtoupper(substr($compassionate->user->middlename,0,1)) }}{{ "." }}{{ " " }}{{ Str::ucfirst(strtolower($compassionate->user->lastname)) }}</td>
                            <td>{{ $compassionate->user->office_division }} </td>
                            <td>{{ \Carbon\Carbon::parse($compassionate->date2)->format('F j, Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($compassionate->date3)->format('F j, Y') }}</td>
                            <td>@if ($compassionate->filialObligation){{ $compassionate->filialObligation->reason; }}
                                @elseif ($compassionate->familyReunion){{ $compassionate->familyReunion->reason; }}
                                @elseif ($compassionate->deathAnniversary){{ $compassionate->deathAnniversary->reason; }}
                                @elseif ($compassionate->anteMortem){{ $compassionate->anteMortem->reason; }}
                                @elseif ($compassionate->attendanceCourt){{ $compassionate->attendanceCourt->reason; }}
                                @endif</td>
                            <td>{{ strtoupper($compassionate->statusCompassionateTO->head) }}</td>
                            <td><button  class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#myModal-{{  $compassionate->id }}">View</button></td>
                            <div class="modal" id="myModal-{{ $compassionate->id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title secondary">Action</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <form action="{{ route('leave-request.compassionateTO.update' ,$compassionate->id) }}" method="POST">
                                            @method('PATCH')
                                            @csrf
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <div class="mb-4">
                                                        <label class="form-label"><b>COMPASSIONATE TIME-OFF FORM: </b></label>
                                                        <a type="button" class="btn btn-info center form-control" href="{{ route('compassionateTO.form', $compassionate->id) }}" target="_blank">View</a>
                                                    </div>
                                                    <div class="mb-4">
                                                        @if ($compassionate->deathAnniversary)
                                                        <label class="form-label"><b>ATTACHMENT(S): </b></label>
                                                        <a href="{{ asset('attachment/death_cert/'.$compassionate->deathAnniversary->death_cert) }}" target="_blank" type="button" class="btn btn-info center form-control">View</a>
                                                        @elseif ($compassionate->anteMortem)
                                                        <label class="form-label"><b>ATTACHMENT(S): </b></label>
                                                        <a href="{{ asset('attachment/hosp_cert/'.$compassionate->anteMortem->doc_cert) }}" target="_blank" type="button" class="btn btn-info center form-control">View</a>
                                                        @elseif ($compassionate->attendanceCourt)
                                                        <label class="form-label"><b>ATTACHMENT(S): </b></label>
                                                        <a href="{{ asset('attachment/court_cert/'.$compassionate->attendanceCourt->court_cert) }}" target="_blank" type="button" class="btn btn-info center form-control">View</a>
                                                        @endif
                                                    </div>

                                                    {{-- <label class="form-label">If for evaluation, type your message here.</label>
                                                    <textarea name="remark" id="" cols="30" rows="5" class="form-control" ></textarea> --}}
                                                </div>
                                                <div class="mb-3">
                                                    <div class="mb-4">
                                                        <label class="form-label"><b>STATUS: </b></label>
                                                        <select name="status" class="form-control" required="true">
                                                            <option value="" selected="true" disabled>Pending</option>
                                                            <option value="approved">Approved</option>
                                                            <option value="reject">Reject</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                    {{-- <div>
                                                        <div class="mb-3">
                                                            <label for="formFile" class="form-label">Upload Certificate</label>
                                                            <input class="form-control" type="file" id="formFile" name="certificate">
                                                        </div>
                                                    </div> --}}
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </tr>
                        @endforeach
                        </tbody>
                            {{-- <div class="modal" id="myModal-{{ $compassionate->id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title secondary">View</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <form action="{{ route('compassionateTO.update' ,$compassionate->id) }}" method="POST" enctype="multipart/form-data">
                                            @method('PATCH')
                                            @csrf
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <div class="mb-4">
                                                        <label class="form-label"><b>REGISTRATION FORM: </b></label>
                                                        <a type="button" class="btn btn-info center form-control" href="{{ route('compassionateTO.form', $compassionate->id) }}" target="_blank">View</a>
                                                    </div>

                                                    <label class="form-label">If for evaluation, type your message here.</label>
                                                    <textarea name="remark" id="" cols="30" rows="5" class="form-control" ></textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="mb-4">
                                                        <label class="form-label"><b>STATUS: </b></label>
                                                        <select name="status" class="form-control" required="true">
                                                            <option value="" selected="true" disabled>Pending</option>
                                                            <option value="approved">Approved</option>
                                                            <option value="for evaluation">For evaluation</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                    <div>
                                                        <div class="mb-3">
                                                            <label for="formFile" class="form-label">Upload Certificate</label>
                                                            <input class="form-control" type="file" id="formFile" name="certificate">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-prima
                                                    ry">Update</button>
                                                </div>
                                        </form>
                                    </div>
                                </div>
                            </div> --}}
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

</div> <!-- container-fluid -->

@endsection

