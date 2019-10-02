@component('mail::message')
    # Introduction

    Please confirm your subscription.

    @component('mail::button', ['url' => route('confirm', ['id' => $id, 'email' => $email])])
        Confirm
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
