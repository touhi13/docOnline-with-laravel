@extends('layouts.admin')
@section('title')
    Doctorkhuji || Transaction List
@endsection
@section('content')
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">Transactions</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Transactions</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="datatable table table-hover table-center mb-0">
                                <thead>
                                    <tr>
                                        <th>Invoice Number</th>
                                        <th>Patient ID</th>
                                        <th>Patient Name</th>
                                        <th>Total Amount</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transactions as $transaction)
                                        <tr>
                                            <td><a href="invoice.html">#IN{{ $transaction->id }}</td>
                                            <td>#PT{{ $transaction->patient->id }}</td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="profile.html" class="avatar avatar-sm mr-2">
                                                        @if ($transaction->patient->photo)
                                                            <img class="avatar-img rounded-circle"
                                                                src="{{ asset('images/patients/' . $transaction->patient->photo) }}"
                                                                alt="{{ $transaction->patient->name }}">
                                                        @else
                                                            <img class="avatar-img rounded-circle"
                                                                src="{{ asset('assets/img/profile.png') }}"
                                                                alt="{{ $transaction->patient->name }}">
                                                        @endif
                                                    </a>
                                                    <a href="profile.html">
                                                        {{ $transaction->patient->name }}
                                                    </a>
                                                </h2>
                                            </td>
                                            <td>{{ $transaction->total_amount }}</td>
                                            <td class="text-center">
                                                <span class="badge badge-pill bg-success inv-badge">
                                                    {{ $transaction->status }}
                                                </span>
                                            </td>
                                            <td class="text-right">
                                                <div class="actions">
                                                    <form action="{{ route('transaction.destroy', $transaction->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            Delete
                                                        </button>
                                                    </form>

                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
