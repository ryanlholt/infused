<div class="p-4">
    <h1 class="text-3xl">Infused Settings</h1>
    {{session()->get('infused_status')}}
    @if (session()->exists('infused_auth_status') && session('infused_auth_status') === 1)
        <div class="flex flex-wrap items-center">
            <p class="w-full text-lg font-bold">
                Status: Connected
                <span class="text-green-500 ml-2">
                    <i class="fa fa-check"></i>
                </span>
            </p>
            <a class="block w-40 bg-green-600 rounded text-white font-bold py-2 px-4 mt-4 text-center" href="{{app('infused')->infusionsoft()->getAuthorizationUrl()}}">Re-Authorize</a>
        </div>
    @else
        <div class="alert alert-block alert-success">
            <p class="w-full text-lg font-bold">
                Status: Disconnected
                <span class="text-red-700 ml-2">
                    <i class="fa fa-times inline"></i>
                </span>
            </p>
            <a class="block w-40 bg-green-600 rounded text-white font-bold py-2 px-4 mt-4 text-center" href="{{app('infused')->infusionsoft()->getAuthorizationUrl()}}">Re-Authorize</a>
        </div>
    @endif
</div>
