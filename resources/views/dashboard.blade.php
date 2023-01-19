@extends('layouts.template')
@section('title', 'Dashboard')
@section('content')

    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                Donation Zone
            </a>
            <div
                class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <div class="space-y-2">

                        <div class="flex items-center justify-between">
                            <h1
                                class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                                Php {{ $total_amount }}
                            </h1>
                            <p class="text-sm text-primary-blue-light hover:underline dark:text-primary-blue-light">
                                <b>99</b> days left
                            </p>

                        </div>
                        <div class="w-full bg-gray-400 rounded-full">
                            <div class="bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-l-full"
                                style="width: {{ $remaining_amount }}%"> {{ $remaining_amount }}%</div>
                        </div>



                        <div class="flex items-center justify-between">
                            <div class="flex items-start">
                                <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                                    Philippine Pesos Raised
                                </p>

                            </div>
                            <a href="#"
                                class="text-sm font-medium text-primary-blue-light hover:underline dark:text-primary-blue-light">
                                {{ $backer }} backers</a>
                        </div>

                    </div>
                    <form class="space-y-4 md:space-y-6" id="payment" action="{{ route('payment') }}" method="POST">
                        @csrf
                        <div>
                            <label for="Amount"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Donate in Php</label>
                            <input type="text" name="amount" id="amount"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Donation">
                            @if ($errors->has('amount'))
                                <p class="text-sm font-light text-red-500 dark:text-red-500">
                                    {{ $errors->first('amount') }}</p>
                            @endif

                            @if (Session::has('failed'))
                                <p class="text-sm font-light text-red-500 dark:text-red-500">
                                    Payment was not successful. Please try again.</p>
                            @endif

                            @if (Session::has('success'))
                                <p class="text-sm font-light text-green-500 dark:text-green-500">
                                    Payment successful. Thank you!</p>
                            @endif
                        </div>
                        <button type="submit" data-modal-target="staticModal" data-modal-toggle="staticModal"
                            class="w-full text-white bg-primary-red-light hover:bg-primary-red-heavy focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Powered
                            by Paypal</button>


                        <div id="staticModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
                            class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
                            <div class="relative w-full h-full max-w-md md:h-auto">
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <div class="p-6 text-center">
                                        <h1
                                            class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                                            Loading....
                                        </h1>

                                        <div role="status" class="space-y-2">

                                            <svg aria-hidden="true"
                                                class="inline w-10 h-10 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                                    fill="currentColor" />
                                                <path
                                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                                    fill="currentFill" />
                                            </svg>
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Redirecting
                                            you to our paypal payment gateway</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Main modal -->
                    </form>
                    <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                        Don't want to donate anymber? <a href="{{ route('logout') }}"
                            class="font-medium text-primary-blue-light hover:underline dark:text-primary-blue-light">
                            Logout</a>
                    </p>
                </div>
            </div>
        </div>



    </section>

@endsection
