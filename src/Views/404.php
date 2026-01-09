<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <title>404 - Page Introuvable</title>
    <style>
        body { background-color: #0b0f1a; }
        .glass {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        .glow {
            box-shadow: 0 0 50px -10px rgba(139, 92, 246, 0.3);
        }
    </style>
</head>
<body class="h-screen flex items-center justify-center overflow-hidden text-white">

    <div class="absolute top-1/4 left-1/4 w-64 h-64 bg-purple-600/20 rounded-full blur-[100px]"></div>
    <div class="absolute bottom-1/4 right-1/4 w-64 h-64 bg-blue-600/20 rounded-full blur-[100px]"></div>

    <div class="relative z-10 text-center px-6">
        <h1 class="text-[12rem] font-black leading-none bg-gradient-to-b from-white to-white/10 bg-clip-text text-transparent opacity-20">
            404
        </h1>

        <div class="glass glow -mt-20 p-10 rounded-[3rem] max-w-lg mx-auto">
            <h2 class="text-3xl font-bold mb-4">Oups ! Page perdue.</h2>
            <p class="text-slate-400 mb-8 leading-relaxed">
                Il semble que le chapitre que vous cherchez n'ait pas encore été écrit ou a été déplacé ailleurs.
            </p>

            <a href="/" class="inline-flex items-center gap-3 bg-gradient-to-r from-purple-600 to-indigo-600 px-8 py-4 rounded-2xl text-sm font-black uppercase tracking-widest hover:scale-105 active:scale-95 transition-all shadow-xl shadow-purple-900/40">
                <i class="fa-solid fa-house"></i>
                Retour à l'accueil
            </a>
        </div>

        <p class="mt-8 text-slate-600 text-xs font-medium uppercase tracking-[0.3em]">
            ReadUp Dashboard System
        </p>
    </div>

</body>
</html>