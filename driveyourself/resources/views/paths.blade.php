@extends('canevas')
@section('title', 'Paths')
@section('header', 'Paths')

@section('content')
<div class="padder">
    @foreach ($paths as $path)
        @switch($path->level)
            @case(0)
                @php($color = '#55efc4')
                @break
            @case(1)
                @php($color = '#ffeaa7')
                @break
            @case(2)
                @php($color = '#fab1a0')
                @break
            @default
                @php($color = '#b2bec3')
        @endswitch
    <div class="card border-dark rounded-5" style="background-color:{{ $color }}; margin:auto; width:30%; padding:10px; margin-bottom:40px;">
        <div class="row">
            <div class="card-name">
                <p class="m-3 fw-bold fs-4">{{ $path->examinationCenter->name }}</p>
            </div>
        </div>

        <div class="row mt-2 pt-4 pb-4 border-top border-bottom border-dark">
            <div class="col">
                <div class="card-type text-center">
                    <p>Type</p>

                    <div style="background-color: #dfe6e9; border-radius: 100px; ">
                        {{ $path->pathType->type}}
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card-level text-center">
                    <p >Level</p>
                    <div  style="background-color: #dfe6e9; border-radius: 100px; width: 20%; margin:auto;">

                        {{ $path->level }}
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col text-center">
                <div class="row">
                    <div class="card-duration">
                        {{ $path->duration }}
                    </div>
                </div>
                <div class="row">
                    <div class="card-distance">
                        {{ $path->distance }} km
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card-go text-center">
                    <a class="btn rounded-5 fw-bold" href="@" style="background-color: #fdcb6e;">Y-aller <i class="fa fa-car"></i></a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
