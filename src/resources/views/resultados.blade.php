@extends('layouts.resultados')

@section('content')

            <div class="max-w-10xl mx-auto sm:px-10 lg:px-10">

                <div id="principal" class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                    <div id="associados-box" class="grid grid-cols-1 md:grid-cols-1">
                        <div class="p-3">
                            <div class="flex items-center icon-votacao">
                                <img src="{{URL::asset('icons/votacao.png')}}" class="w-8 h-8 text-gray-500" />
                                <div class="ml-4 text-lg leading-7 font-semibold">
                                    {{ config('app.name') }}
                                </div>
                            </div>

                            <div class="ml-12 responsive">
                                <table id="votacoes" class="table table-sm table-striped table-hover text-nowrap">
                                </table>
                            </div>
                        </div>
                        <div class="p-3">
                        </div>
                    </div>
                </div>

                <div class="flex justify-center mt-4 sm:items-center sm:justify-between">
                    <div class="text-center text-sm text-gray-500 sm:text-left">
                        <div class="flex items-center">
                            <!--
                                <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" class="-mt-px w-5 h-5 text-gray-400">
                                <path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            -->

                            <a href="https://sinprofaz.org.br" class="ml-1 underline">
                                SINPROFAZ
                            </a>
                        </div>
                    </div>

                    <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
                        {{ config('app.name') }}.
                        Copyright © 2022-{{ date('Y') }}.
                        Todos os direitos reservados.
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal-resultado" role="dialog">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Resultado</h4>
                    </div>
                        <div class="modal-body">
                            <h3 id="votacao-nome"></h3>
                            <div id="votacao" class="grid grid-cols-1 md:grid-cols-1" style="width: 100%;">
                            </div>
                        </div>
                    <div class="modal-footer">
                        <button id="voltar" type="button" class="btn btn-danger close" data-dismiss="modal">Voltar</button>
                    </div>
                </div>
            </div>
        </div>

@endsection
