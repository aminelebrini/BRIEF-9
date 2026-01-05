<?php use Controllers\AuthentificationController;
use Controllers\AdminController; ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&display=swap" rel="stylesheet">
    <title>ReadUp | Admin Dashboard</title>
    <style>
        body { font-family: 'Outfit', sans-serif; background: #0b0f1a; color: white; margin: 0; }
        .glass { background: rgba(255, 255, 255, 0.03); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.1); }
        .sidebar-item-active { background: linear-gradient(to right, rgba(79, 70, 229, 0.1), transparent); border-left: 4px solid #4f46e5; }
        .blob { filter: blur(80px); position: fixed; z-index: 0; pointer-events: none; } /* Ajout de pointer-events: none */
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-thumb { background: rgba(255, 255, 255, 0.1); border-radius: 10px; }
    </style>
</head>
<body class="flex min-h-screen bg-[#0b0f1a]">

    <div class="blob w-[500px] h-[500px] bg-indigo-600/10 -top-24 -left-24"></div>
    <div class="blob w-[400px] h-[400px] bg-purple-600/5 bottom-0 right-0"></div>

    <aside class="w-72 glass border-r border-white/10 flex flex-col fixed h-full z-50">
        <div class="p-8">
            <h1 class="text-2xl font-black tracking-tighter text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-purple-400">READUP DASH</h1>
        </div>

        <nav class="flex-1 px-4 space-y-2">
            <div class="text-[10px] uppercase tracking-[0.2em] text-slate-500 font-bold mb-4 px-4">Menu Principal</div>
            
            <a class="sidebar-item-active flex items-center gap-4 px-4 py-4 rounded-xl text-indigo-400 font-bold transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
                Catégories
            </a>

            <a href="/admin/comments" class="flex items-center gap-4 px-4 py-4 rounded-xl text-slate-400 hover:bg-white/5 hover:text-white transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                </svg>
                Commentaires
            </a>

            <a class="flex items-center gap-4 px-4 py-4 rounded-xl text-slate-400 hover:bg-white/5 hover:text-white transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l5 5v11a2 2 0 01-2 2z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 4v5h5"></path>
                </svg>
                Articles
            </a>
        </nav>

        <div class="p-6">
            <div class="glass p-4 rounded-2xl flex items-center gap-3 bg-white/[0.02]">
                <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=<?= $_SESSION['user']['first_name'] ?>" class="w-10 h-10 rounded-lg bg-indigo-500/20">
                <div class="overflow-hidden">
                    <p class="text-xs font-bold truncate"><?= $_SESSION['user']['first_name'] . " " . $_SESSION['user']['last_name']?></p>
                    <form action="/logout" method="POST">
                        <button type="submit" name="logout" class="text-[10px] text-red-400 font-bold uppercase hover:underline">Déconnexion</button>
                    </form>
                </div>
            </div>
        </div>
    </aside>

    <main class="display flex-1 ml-72 p-12 relative z-10">
        
        <div class="flex justify-between items-end mb-12">
            <div>
                <h2 class="text-4xl font-black">Catégories</h2>
                <p class="text-slate-500 text-sm mt-2 font-medium italic">Gérez les thématiques de lecture</p>
            </div>
            <a href="/feed" class="glass px-6 py-2.5 rounded-xl text-xs font-bold hover:bg-white/10 transition-all uppercase tracking-widest border border-white/5">
                Retour au site
            </a>
        </div>

        <div class="grid lg:grid-cols-12 gap-10 items-start">
            
            <div class="lg:col-span-4 sticky top-12">
                <div class="glass p-8 rounded-[2.5rem] bg-white/[0.01]">
                    <h3 class="font-bold mb-8 flex items-center gap-3 text-indigo-400 uppercase text-xs tracking-widest">
                        <span class="w-2 h-2 bg-indigo-500 rounded-full shadow-[0_0_10px_rgba(99,102,241,0.5)]"></span>
                        Nouveau Catégorie
                    </h3>
                    <form action="/add_category" method="POST" class="space-y-6">
                        <div class="space-y-2">
                            <input type="text" name="category_name" required placeholder="Ex: Cyberpunk..." 
                               class="w-full bg-white/5 border border-white/10 px-5 py-4 rounded-2xl focus:outline-none focus:ring-2 focus:ring-indigo-500/50 transition-all text-sm placeholder:text-slate-600">
                        </div>
                        <button type="submit" name="add_category" class="w-full py-4 rounded-2xl bg-indigo-600 text-white text-xs font-black hover:bg-indigo-500 shadow-xl shadow-indigo-900/40 transition-all uppercase tracking-widest">
                            Ajouter au système
                        </button>
                    </form>
                </div>
            </div>

            <div class="lg:col-span-8">
                <div class="grid md:grid-cols-2 gap-4">
                    <?php if(isset($Categories)): ?>
                        <?php foreach($Categories as $category): ?>
                        <div class="glass p-6 rounded-[2rem] flex items-center justify-between group border border-white/5 hover:border-indigo-500/30 hover:bg-white/[0.04] transition-all duration-300">
                            <div class="flex items-center gap-5">
                                <div class="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center text-[10px] font-mono text-slate-500 border border-white/5">
                                    #<?= $category['id'] ?>
                                </div>
                                <span class="font-bold text-slate-200 uppercase tracking-wide text-sm group-hover:text-white transition-colors">
                                    <?= $category['category_name'] ?>
                                </span>
                            </div>
                            
                            <form method="POST" action="/remove_category" onsubmit="return confirm('Supprimer ?');">
                                <button class="text-slate-600 hover:text-red-400 transition-all p-2 rounded-lg hover:bg-red-500/10" type="submit" name="remove_categorie" value="<?= $category['id'] ?>">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                </button>
                            </form>
                        </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="col-span-full glass p-12 rounded-[2.5rem] text-center border-dashed border-white/10">
                            <p class="text-slate-500 italic text-sm">Aucune catégorie disponible</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

        </div>

        <div></div>
    </main>

</body>
</html>