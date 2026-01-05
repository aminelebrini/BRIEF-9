<?php 

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&display=swap" rel="stylesheet">
    <title>ReadUp | Author Dash</title>
    <style>
        body { font-family: 'Outfit', sans-serif; background: #0b0f1a; color: white; margin: 0; overflow-x: hidden; }
        .glass { background: rgba(255, 255, 255, 0.03); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.1); }
        .sidebar-item-active { background: linear-gradient(to right, rgba(139, 92, 246, 0.2), transparent); border-left: 4px solid #8b5cf6; }
        .blob { filter: blur(80px); position: fixed; z-index: 0; pointer-events: none; }
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-thumb { background: rgba(255, 255, 255, 0.1); border-radius: 10px; }
    </style>
</head>
<body class="flex min-h-screen bg-[#0b0f1a]">

    <div class="blob w-[500px] h-[500px] bg-purple-600/10 -top-24 -left-24"></div>

    <aside class="w-72 glass border-r border-white/10 flex flex-col fixed h-full z-50">
        <div class="p-8">
            <h1 class="text-2xl font-black tracking-tighter text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-pink-400">AUTHOR SPACE</h1>
        </div>

        <nav class="flex-1 px-4 space-y-2">
            <div class="text-[10px] uppercase tracking-[0.2em] text-slate-500 font-bold mb-4 px-4">Ma Plume</div>
            
            <a href="/authordash" class="sidebar-item-active flex items-center gap-4 px-4 py-4 rounded-xl text-purple-400 font-bold transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                Vue d'ensemble
            </a>

            <a href="/author/my-articles" class="flex items-center gap-4 px-4 py-4 rounded-xl text-slate-400 hover:bg-white/5 hover:text-white transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                Mes Articles
            </a>

            <a href="/author/write" class="flex items-center gap-4 px-4 py-4 rounded-xl text-slate-400 hover:bg-white/5 hover:text-white transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Nouvel Article
            </a>
        </nav>

        <div class="p-6">
            <div class="glass p-4 rounded-2xl flex items-center gap-3 bg-white/[0.02]">
                <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=<?= $_SESSION['user']['first_name'] ?>" class="w-10 h-10 rounded-lg bg-purple-500/20">
                <div class="overflow-hidden">
                    <p class="text-xs font-bold truncate"><?= $_SESSION['user']['first_name'] ?></p>
                    <span class="text-[9px] text-purple-400 font-bold uppercase tracking-tighter">Auteur certifié</span>
                </div>
            </div>
        </div>
    </aside>

    <main class="flex-1 ml-72 p-12 relative z-10">
        
        <div class="flex justify-between items-center mb-12">
            <div>
                <h2 class="text-4xl font-black">Bonjour, <?= $_SESSION['user']['first_name'] ?> 👋</h2>
                <p class="text-slate-500 text-sm mt-2 font-medium italic">Prêt à inspirer vos lecteurs aujourd'hui ?</p>
            </div>
            <div class="flex gap-4">
                <a href="/feed" class="glass px-6 py-2.5 rounded-xl text-xs font-bold hover:bg-white/10 transition-all uppercase tracking-widest border border-white/5">Lire le feed</a>
                <button class="bg-purple-600 px-6 py-2.5 rounded-xl text-xs font-bold hover:bg-purple-500 transition-all uppercase tracking-widest shadow-lg shadow-purple-900/40">Écrire</button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <div class="glass p-8 rounded-[2rem] border-l-4 border-purple-500">
                <p class="text-slate-500 text-xs font-bold uppercase tracking-widest">Articles publiés</p>
                <h3 class="text-4xl font-black mt-2">14</h3>
            </div>
            <div class="glass p-8 rounded-[2rem] border-l-4 border-blue-500">
                <p class="text-slate-500 text-xs font-bold uppercase tracking-widest">Lectures totales</p>
                <h3 class="text-4xl font-black mt-2">3.8k</h3>
            </div>
            <div class="glass p-8 rounded-[2rem] border-l-4 border-pink-500">
                <p class="text-slate-500 text-xs font-bold uppercase tracking-widest">Commentaires reçus</p>
                <h3 class="text-4xl font-black mt-2">127</h3>
            </div>
        </div>

        <div class="grid lg:grid-cols-12 gap-10">
            <div class="lg:col-span-8">
                <h3 class="text-xl font-bold mb-6 flex items-center gap-3">
                    <span class="w-1.5 h-6 bg-purple-500 rounded-full"></span>
                    Publications récentes
                </h3>
                
                <div class="space-y-4">
                    <div class="glass p-6 rounded-[2rem] group hover:bg-white/[0.04] transition-all border border-white/5">
                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-[10px] text-purple-400 font-bold uppercase tracking-widest">Technologie</span>
                                <h4 class="text-lg font-bold mt-1">L'IA dans le développement moderne</h4>
                                <p class="text-slate-500 text-xs mt-1">Publié le 02 Janvier 2026 • 5 min de lecture</p>
                            </div>
                            <div class="flex gap-2 opacity-0 group-hover:opacity-100 transition-all">
                                <button class="p-3 rounded-xl bg-white/5 text-slate-400 hover:text-white">Modifier</button>
                                <button class="p-3 rounded-xl bg-red-500/10 text-red-400 hover:bg-red-500/20">Suppr.</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-4">
                <div class="glass p-8 rounded-[2.5rem] bg-gradient-to-br from-purple-600/10 to-transparent">
                    <h3 class="font-bold mb-4">Astuce d'écriture 💡</h3>
                    <p class="text-sm text-slate-400 leading-relaxed">
                        Les articles avec une image de couverture percutante reçoivent en moyenne 40% de clics en plus. Pensez à soigner vos visuels !
                    </p>
                </div>
            </div>
        </div>
    </main>

</body>
</html>