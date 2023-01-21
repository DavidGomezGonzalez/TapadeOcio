<div class="block p-6 rounded-lg shadow-lg bg-white">
    <form action="{{ route('users.update', ['id'=>$model->id]) }}" method="POST" class="w-full max-w-lg">
        @csrf
        @method('PUT')
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                    {{ __('Name') }}
                </label>
                <input
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 /*border-red-500*/ rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                    name="name" type="text" placeholder="{{ __('Name') }}" value="{{ $model->name }}">
                <!-- <p class="text-red-500 text-xs italic">Please fill out this field.</p> -->
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                    {{ __('Email') }}
                </label>
                <input
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 /*border-red-500*/ rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                    name="email" type="email" placeholder="{{ __('Email') }}" value="{{ $model->email }}">
                <!-- <p class="text-red-500 text-xs italic">Please fill out this field.</p> -->
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                    {{ __('Password') }}
                </label>
                <input
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    name="password" type="password" placeholder="******************">
                <!--  <p class="text-gray-600 text-xs italic">Make it as long and as crazy as youd like</p> -->
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-2">
            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-city">
                    {{ __('City') }}
                </label>
                <input
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    id="grid-city" type="text" placeholder="Albuquerque">
            </div>
            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
                    State
                </label>
                <div class="relative">
                    <select
                        class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        id="grid-state">
                        <option>New Mexico</option>
                        <option>Missouri</option>
                        <option>Texas</option>
                    </select>
                </div>
            </div>
            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-zip">
                    Zip
                </label>
                <input
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    id="grid-zip" type="text" placeholder="90210">
            </div>
        </div>

        <div class="flex my-10">
            <button class="bg-andalusia hover:bg-andalusia text-white font-bold py-2 px-4 w-full rounded mx-auto ">
                {{ __('Save') }}
            </button>
        </div>
    </form>
</div>
