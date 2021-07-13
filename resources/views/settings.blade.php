<h1>Infused Settings</h1>

@if(Session::has('infused_status'))
    <div class="alert alert-block alert-success">
        <i class=" fa fa-check cool-green "></i>
        {{ nl2br(Session::get('infused_status')) }}
        <a href="{{App::make(Infused::class)->infusionsoft->getAuthorizationUrl()}}">Authorize</a>
    </div>
@endif
