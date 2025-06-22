@extends('layouts.admin')
@section('content')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Bank Account infomation</h3>
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
                        <a href="{{ route('admin.bank') }}">
                            <div class="text-tiny">Bank</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">New Account Bank</div>
                    </li>
                </ul>
            </div>
            <div class="wg-box">
                <form class="form-new-product form-style-1" method="POST" action="{{ route('admin.bank.store') }}">
                    @csrf
                    <fieldset class="name">
                        <div class="body-title">BANK</div>
                        <div class="select flex-grow">
                            <select class="" name="BANK">
                                <option value="">Pilih Bank</option>
                                <option value="BCA">BCA</option>
                                <option value="Mandiri">Mandiri</option>
                                <option value="BRI">BRI</option>
                                <option value="BSI">BSI</option>
                            </select>
                        </div>
                    </fieldset>
                    @error('BANK')
                        <span class="alert alert-danger text-center">{{ $message }}</span>
                    @enderror

                    <fieldset class="name">
                        <div class="body-title">No Rekening <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="No rekening" name="rekening" tabindex="0"
                            value="{{ old('rekening') }}" aria-required="true" required="">
                    </fieldset>
                    @error('rekening')
                        <span class="alert alert-danger text-center">{{ $message }}</span>
                    @enderror

                    <fieldset class="name">
                        <div class="body-title">Nama Rekening<span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Nama rekening" name="nama" tabindex="0"
                            value="{{ old('nama') }}" aria-required="true" required="">
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
