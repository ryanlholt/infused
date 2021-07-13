<h1>Infused Settings</h1>

@if (session()->exists('infused_auth_status') && session('infused_auth_status') === 1)
    <div class="alert alert-block alert-success flex items-center">
        <p class="text-lg font-bold">Infusionsoft is Authorized!</p>
        <i class=" fa fa-check cool-green inline"></i>
        <a href="{{app('infused')->infusionsoft()->getAuthorizationUrl()}}">Re-Authorize</a>
    </div>
@else
    <div class="alert alert-block alert-success">
        <p class="text-lg font-bold">Infusionsoft is not Authorized!</p>
        <i class=" fa fa-check color-danger "></i>
        <a href="{{app('infused')->infusionsoft()->getAuthorizationUrl()}}">Re-Authorize</a>
    </div>
@endif


