@extends('layouts.admin')
@section('content')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Bank infomation</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="{{ route('admin.index') }}">
                            <div class="text-tiny">Dashboard</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <a href="{{ route('admin.coupons') }}">
                            <div class="text-tiny">Bank</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Edit Bank</div>
                    </li>
                </ul>
            </div>
            <div class="wg-box">
                <form class="form-new-product form-style-1" method="POST" action="{{ route('admin.bank.update') }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $bank->id }}">
                    <fieldset class="name">
                        <div class="body-title">BANK</div>
                        <div class="select flex-grow">
                            <select class="" name="BANK">
                                <option value="">Select</option>
                                <option value="BCA" {{ $bank->BANK == 'BCA' ? 'selected' : '' }}>BCA</option>
                                <option value="Mandiri" {{ $bank->BANK == 'Mandiri' ? 'selected' : '' }}>Mandiri</option>
                                <option value="BRI" {{ $bank->BANK == 'BRI' ? 'selected' : '' }}>BRI</option>
                                <option value="BSI" {{ $bank->BANK == 'BSI' ? 'selected' : '' }}>BSI</option>

                            </select>
                        </div>
                    </fieldset>
                    @error('BANK')
                        <span class="alert alert-danger text-center">{{ $message }}</span>
                    @enderror

                    <fieldset class="name">
                        <div class="body-title">No Rekening <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="No rekening" name="rekening" tabindex="0"
                            value="{{ $bank->rekening }}" aria-required="true" required="">
                    </fieldset>
                    @error('rekening')
                        <span class="alert alert-danger text-center">{{ $message }}</span>
                    @enderror

                    <fieldset class="name">
                        <div class="body-title">Nama <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Nama" name="nama" tabindex="0"
                            value="{{ $bank->nama }}" aria-required="true" required="">
                    </fieldset>
                    @error('nama')
                        <span class="alert alert-danger text-center">{{ $message }}</span>
                    @enderror
                    <div class="bot">
                        <div></div>
                        <button class="tf-button w208" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
