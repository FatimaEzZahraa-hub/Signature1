<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bienvenue sur EduTrustSign</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #4b0082;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 0 0 5px 5px;
        }
        .credentials {
            background-color: #fff;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin: 20px 0;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4b0082;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Bienvenue sur EduTrustSign</h1>
    </div>
    
    <div class="content">
        <p>Bonjour {{ $user->first_name }},</p>
        
        <p>Votre compte a été créé avec succès sur la plateforme EduTrustSign. Voici vos identifiants de connexion :</p>
        
        <div class="credentials">
            <p><strong>Email :</strong> {{ $user->email }}</p>
            <p><strong>Mot de passe temporaire :</strong> {{ $password }}</p>
        </div>
        
        <p>Pour des raisons de sécurité, nous vous recommandons de changer votre mot de passe dès votre première connexion.</p>
        
        <p>
            <a href="{{ url('/login') }}" class="button">Se connecter</a>
        </p>
        
        <p>Si vous avez des questions, n'hésitez pas à nous contacter.</p>
        
        <p>Cordialement,<br>L'équipe EduTrustSign</p>
    </div>
    
    <div class="footer">
        <p>Cet email a été envoyé automatiquement, merci de ne pas y répondre.</p>
    </div>
</body>
</html> 