{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@php $title = ucfirst(Request::segment(2)); @endphp

@section('title', "Detalhes do Plano")

@section('tools')
<a href="{{ route('details.plan.create', $plan->id) }}" class="btn btn-dark">
    <i class="far fa-plus-square"></i>
</a>
<a href="{{ route('plans.index') }}" class="btn btn-dark">
    <i class="fas fa-angle-double-left"></i>
</a>
@endsection

@section('content_header')
<h1>
    <i class="fa fa-list"></i>
    @yield('title')
    <b><i>{{ $plan->name }} </i></b>
    @yield('tools')
</h1>
@stop

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ route('plans.index') }}">Planos</a>
</li>
<li class="breadcrumb-item">
    <a href="{{ route('plans.show', $plan->id) }}">{{ $plan->name }}</a>
</li>
<li class="breadcrumb-item active" aria-current="page">
    Detallhes do Planos
</li>
@endsection

@section('content')
<div class="card">

    @include('admin.includes.alerts')

    <div class="card-body">
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach($details as $detail)
                <tr>
                    <td>{{ $detail->name }}</td>
                    <td>
                        <div class="btn-group">
                            <a href="{{ route('details.plan.edit', [$plan->id, $detail->id]) }}" class="btn btn-info"><i class="far fa-edit"></i></a>
                            <a href="{{ route('details.plan.show', [$plan->id, $detail->id]) }}" class="ml-1 btn btn-warning"><i class="far fa-eye"></i></a>
                            <form class="form ml-1" action="{{ route('details.plan.delete', [$plan->id, $detail->id]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Apagar Detalhe</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="paginacao" aria-label="Page navigation">
        @if(isset($filters))
        {{ $details->appends($filters)->links() }}
        @else
        {{ $details->links() }}
        @endif
    </div>
</div>

@stop
