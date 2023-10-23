<x-mail::message>
# Hi, {{ $user->name }}

You have been added to newly created project {{ $project->name }}

<x-mail::button :url="''">
View {{ $project->name }}
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
