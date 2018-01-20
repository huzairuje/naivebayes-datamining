@if (session()->has('flash_notification.message'))
    @if (session()->has('flash_notification.overlay'))
        @include('flash::modal', [
            'modalClass' => 'flash-modal',
            'title'      => session('flash_notification.title'),
            'body'       => session('flash_notification.message')
        ])
    @else
        <div class="alert alert-{{ session('flash_notification.level') }}{{ session()->has('flash_notification.important') ? ' alert-dismissible alert-important' : '' }}" role="alert" id="alert-flash-notification">
            @if(session()->has('flash_notification.important'))
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            @endif
            {!! session('flash_notification.message') !!}
        </div>
        <style type="text/css">
            #alert-flash-notification {
                margin: 15px;
                opacity: .9;
            }
            #alert-flash-notification .close {
                opacity: .5;
            }
        </style>
    @endif
@endif
