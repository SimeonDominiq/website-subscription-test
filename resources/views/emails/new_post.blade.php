@component('mail::message')
# New Post: {{ $post->title }}

{{ $post->description }}

@component('mail::button', ['url' => $post->website->url])
Visit Website
@endcomponent

Thanks,
{{ config('app.name') }}
@endcomponent
