<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
  </head>
  <body>
    <h2>Bonjour,  </h2>
   L'utilsateur {{ $contact['email'] }} a initié une connexion, voici son code de connexion
    <ul>
      <li><strong>OTP</strong> : {{ $contact['message'] }}</li>
    
    </ul>
  </body>
</html>