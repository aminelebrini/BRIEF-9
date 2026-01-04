
<?php 

    use Controllers\AdminController;

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&display=swap" rel="stylesheet">
    <title>ReadUp | Dash Categories</title>
    <style>
        body { font-family: 'Outfit', sans-serif; background: #0b0f1a; color: white; }
        .glass { background: rgba(255, 255, 255, 0.03); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.1); }
        .blob { filter: blur(80px); position: fixed; z-index: -1; }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-thumb { background: rgba(255, 255, 255, 0.1); border-radius: 10px; }
    </style>
</head>
<body class="min-h-screen">

    <div class="blob w-full h-96 bg-indigo-600/10 top-[-10%] left-0"></div>
    <div class="blob w-96 h-96 bg-purple-600/10 bottom-0 right-0"></div>

    <div class="max-w-5xl mx-auto px-4 lg:px-8 pt-24 pb-20">
        <div class="message"><?= $_SESSION['flash']['message'] ?></div>
        <div class="flex items-center justify-between mb-12">
            <div>
                <h1 class="text-4xl font-extrabold tracking-tight">Gestion des <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-purple-400">Catégories</span></h1>
                <p class="text-slate-400 mt-2">Organisez les thématiques de la plateforme ReadUp.</p>
            </div>
            <a href="/feed" class="glass px-6 py-2 rounded-xl text-sm font-semibold hover:bg-white/5 transition-all">
                Retour au Feed
            </a>
        </div>

        <?php if (isset($_SESSION['flash'])): ?>
        <?php endif; ?>
        <div class="grid lg:grid-cols-3 gap-8">
            
            <aside class="lg:col-span-1 space-y-6">
                <div class="glass p-6 rounded-[2.5rem] sticky top-24">
                    <div class="relative w-20 h-20 mx-auto mb-4">
                        <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=<?= $_SESSION['user']['first_name'] ?>" alt="Avatar" class="rounded-2xl bg-indigo-500/20 p-1 border border-white/10">
                        <div class="absolute -bottom-1 -right-1 bg-green-500 w-4 h-4 border-2 border-[#0b0f1a] rounded-full"></div>
                    </div>
                    
                    <div class="text-center mb-6">
                        <h3 class="text-lg font-bold"><?= $_SESSION['user']['first_name'] . " " . $_SESSION['user']['last_name'] ?></h3>
                        <p class="text-indigo-400 text-[10px] uppercase tracking-widest font-extrabold">Administrateur</p>
                    </div>

                    <div class="space-y-3">
                        <div class="flex justify-between text-[10px] p-3 bg-white/5 rounded-xl border border-white/5">
                            <span class="text-slate-400 uppercase font-bold">Rôle</span>
                            <span class="font-bold text-indigo-300">Super Admin</span>
                        </div>
                    </div>

                    <div class="h-px bg-gradient-to-r from-transparent via-white/10 to-transparent my-6"></div>

                    <h3 class="text-sm font-bold mb-4 flex items-center gap-2">
                        <span class="w-1.5 h-4 bg-indigo-500 rounded-full"></span>
                        Ajouter une catégorie
                    </h3>
                    <form action="/add_category" method="POST" class="space-y-4">
                        <div>
                            <label class="text-[9px] uppercase tracking-widest font-bold text-slate-500 mb-2 block ml-1">Nom de la catégorie</label>
                            <input type="text" name="category_name" required
                                   placeholder="ex: Science-Fiction" 
                                   class="w-full bg-white/5 border border-white/10 px-4 py-3 rounded-xl focus:outline-none focus:border-indigo-500 transition-all text-sm">
                        </div>
                        <button type="submit" name="add_category" 
                                class="w-full py-3 rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 text-xs font-bold hover:opacity-90 shadow-lg shadow-indigo-900/20 transition-all">
                            Créer maintenant
                        </button>
                    </form>
                </div>
            </aside>

            <main class="lg:col-span-2">
                <div class="glass rounded-[2.5rem] overflow-hidden">
                    <div class="p-6 border-b border-white/5 bg-white/[0.01]">
                        <h3 class="text-sm font-bold uppercase tracking-widest text-slate-400">Liste des catégories</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="text-[10px] uppercase tracking-widest text-slate-500 border-b border-white/5">
                                    <th class="px-8 py-4">ID</th>
                                    <th class="px-8 py-4">Désignation</th>
                                    <th class="px-8 py-4 text-right">Action</th>
                                </tr>
                            </thead>
                                <tbody class="divide-y divide-white/5">
                                <? foreach($Categories as $category): ?>
                                <tr class="group hover:bg-white/[0.02] transition-all">
                                    <td class="px-8 py-5 text-sm font-mono text-slate-500"><?= $category['id'] ?></td>
                                    <td class="px-8 py-5">
                                        <span class="px-3 py-1 bg-indigo-500/10 text-indigo-400 rounded-full text-xs font-bold border border-indigo-500/20">
                                            <?= $category['category_name'] ?>
                                        </span>
                                    </td>
                                    <td class="px-8 py-5 text-right">
                                        <form method="POST" action="/remove_category">
                                            <button class="text-slate-500 hover:text-red-400 transition-colors" type="submit" name="remove_categorie" value="<?= $category['id'] ?>">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <? endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>

        </div>
    </div>

    <script>
        setTimeout(function() {
            const flash = document.getElementById('flash-message');
            if (flash) {
                flash.style.transition = "all 0.6s cubic-bezier(0.4, 0, 0.2, 1)";
                flash.style.opacity = "0";
                flash.style.transform = "translateY(-10px)";
                setTimeout(() => flash.remove(), 600);
            }
        }, 3000);
    </script>
</body>
</html>