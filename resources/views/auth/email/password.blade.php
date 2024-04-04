<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>Votre mot de passe </h2>
<strong>{{ $password}}</strong>
<p>pour le changer  cliquez <a href="{{env("APP_URL")."/admin/modify/password"}}">ici</a></p>

</body>
</html>
