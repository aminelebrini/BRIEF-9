<?php

    namespace src\Controllers;

    use data\AuthentificationController;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&display=swap" rel="stylesheet">
    <title>ReadUp | Portail Innovant</title>
    <style>
        body { font-family: 'Outfit', sans-serif; background: #0f172a; overflow: hidden; }
        
        .glass { 
            background: rgba(255, 255, 255, 0.03); 
            backdrop-filter: blur(25px); 
            border: 1px solid rgba(255, 255, 255, 0.1); 
        }

        .blob { filter: blur(60px); position: absolute; z-index: -1; animation: move 20s infinite alternate; }
        @keyframes move {
            from { transform: translate(-10%, -10%) rotate(0deg); }
            to { transform: translate(20%, 20%) rotate(360deg); }
        }

        .sliding-viewport { width: 100%; overflow: hidden; border-radius: 2.5rem; }
        .master-slider { 
            display: flex; 
            transition: transform 0.7s cubic-bezier(0.8, 0, 0.2, 1); 
            width: 200%; 
        }
        .form-section { width: 50%; padding: 3rem; }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen text-white p-4">

    <div class="blob w-96 h-96 bg-indigo-600/30 rounded-full top-0 left-0"></div>
    <div class="blob w-80 h-80 bg-purple-600/20 rounded-full bottom-0 right-0" style="animation-duration: 15s;"></div>

    <div class="relative w-full max-w-lg">
        
        <div class="text-center mb-8">
            <h1 class="text-[40px] font-extrabold tracking-tighter bg-gradient-to-r from-indigo-400 to-purple-400 bg-clip-text text-transparent">ReadUp.</h1>
        </div>

        <div class="sliding-viewport glass shadow-2xl h-auto">
            <div id="master-slider" class="master-slider h-auto">
                
                <div class="form-section">
                    <header class="mb-8 text-center lg:text-left">
                        <h2 class="text-3xl font-bold">Connexion</h2>
                        <p class="text-slate-400 text-sm mt-2 font-light">Accédez à votre bibliothèque personnelle.</p>
                    </header>

                    <form id="form-login" method="POST" action="/login" class="space-y-5">
                        <input type="email" placeholder="Email" name="email" required
                            class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 outline-none focus:border-indigo-500 focus:bg-white/10 transition-all">
                        
                        <input type="password" placeholder="Mot de passe" name="password" required
                            class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 outline-none focus:border-indigo-500 focus:bg-white/10 transition-all">

                        <button type="submit" name="login" class="w-full bg-white text-slate-900 font-bold py-4 rounded-2xl hover:bg-indigo-400 hover:text-white transition-all transform active:scale-95 shadow-xl shadow-white/5">
                            Se Connecter
                        </button>
                    </form>

                    <div class="mt-8 text-center">
                        <button onclick="slide('signup')" class="text-sm text-slate-400 hover:text-white transition-colors">
                            Nouveau ici ? <span class="text-indigo-400 font-semibold italic">Créer un compte</span>
                        </button>
                    </div>
                </div>

                <div class="form-section">
                    <header class="mb-8 text-center lg:text-left">
                        <h2 class="text-3xl font-bold">Inscription</h2>
                        <p class="text-slate-400 text-sm mt-2 font-light">Commencez votre voyage littéraire.</p>
                    </header>

                    <form id="form-signup" method="POST" action="/signup"  class="space-y-5">
                        <input type="text" placeholder="NOM" name="nom" required
                            class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 outline-none focus:border-purple-500 focus:bg-white/10 transition-all">

                        <input type="text" placeholder="PRENOM" name="prenom" required
                            class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 outline-none focus:border-purple-500 focus:bg-white/10 transition-all">
                        
                        
                        <input type="email" placeholder="Email"  name="email" required
                            class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 outline-none focus:border-purple-500 focus:bg-white/10 transition-all">
                        
                        <input type="password" placeholder="Créer un mot de passe" name="password" required
                            class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 outline-none focus:border-purple-500 focus:bg-white/10 transition-all">

                        <button type="submit" name="signup" class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold py-4 rounded-2xl hover:opacity-90 transition-all transform active:scale-95 shadow-xl shadow-indigo-500/20">
                            Rejoindre ReadUp
                        </button>
                    </form>

                    <div class="mt-8 text-center">
                        <button onclick="slide('login')" class="text-sm text-slate-400 hover:text-white transition-colors">
                            Déjà membre ? <span class="text-purple-400 font-semibold italic">Se connecter</span>
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        function slide(target) {
            const slider = document.getElementById('master-slider');
            if (target === 'signup') {
                slider.style.transform = 'translateX(-50%)';
            } else {
                slider.style.transform = 'translateX(0)';
            }
        }
    </script>
</body>
</html>