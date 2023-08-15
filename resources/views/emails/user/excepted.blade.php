@props([
    'userName',
    'groupName',
])

<x-mail::message>

Здравствуйте {{ $userName }}! Истекло время вашего участия в группе {{ $groupName }}.

</x-mail::message>
