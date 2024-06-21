<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invite Project</title>
</head>
<body>
    Hai {{ $anggota->nama }}, {{ $project->IdentityCreator?->nama }} mengundang anda untuk berkolaborasi pada project <a target="_blank" href="{{ route('project.verifyInvite',['id_member'=>base64_encode($invite->id)]) }}">{{$anggota->email}}/{{$project->judul}}</a>.
    <hr>
    Undangan ini akan kedaluwarsa dalam 3 hari<br>
    <a href="{{ route('project.index') }}">Klik menuju halama project</a>
</body>
</html>