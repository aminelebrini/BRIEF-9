<?php

    use Controllers\AuthentificationController;

    $User = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&display=swap" rel="stylesheet">
    <title>ReadUp | Feed</title>
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

    <div class="max-w-7xl mx-auto px-4 lg:px-8 pt-24 flex flex-col lg:flex-row gap-8">
        
        <aside class="lg:w-1/4">
            <div class="glass p-6 rounded-[2rem] sticky top-24">
                <div class="relative w-24 h-24 mx-auto mb-4">
                    <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Felix" alt="Avatar" class="rounded-2xl bg-indigo-500/20 p-1">
                    <div class="absolute -bottom-2 -right-2 bg-green-500 w-5 h-5 border-4 border-[#0b0f1a] rounded-full"></div>
                </div>
                
                <div class="text-center mb-6">
                    <h3 class="text-xl font-bold"><?= $User['first_name'] . " " . $User['last_name']?></h3>
                    <p class="text-slate-400 text-sm italic">Lecteur Passionné</p>
                </div>

                <div class="space-y-3">
                    <div class="flex justify-between text-sm p-3 bg-white/5 rounded-xl">
                        <span class="text-slate-400">livres aimés</span>
                        <span class="font-bold">128</span>
                    </div>
                </div>

                <button class="w-full mt-6 py-3 rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 text-sm font-bold hover:opacity-90 transition-all">
                    Éditer le profil
                </button>
            </div>
        </aside>

        <main class="lg:w-2/4 space-y-8 pb-20">
            <div class="glass p-2 rounded-2xl flex items-center">
                <input type="text" placeholder="Rechercher une pépite..." class="w-full bg-transparent px-4 py-2 outline-none text-sm">
                <button class="bg-white/10 p-2 rounded-xl hover:bg-white/20 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
            </div>

            <article class="glass rounded-[2.5rem] overflow-hidden group hover:border-indigo-500/50 transition-all duration-500">
                <div class="h-64 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1512820790803-83ca734da794?auto=format&fit=crop&q=80&w=1000" 
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" alt="Cover">
                </div>
                <div class="p-8">
                    <div class="flex gap-2 mb-4 text-[10px] uppercase tracking-widest font-bold">
                        <span class="px-3 py-1 bg-indigo-500/20 text-indigo-400 rounded-full">Littérature</span>
                        <span class="px-3 py-1 bg-slate-500/20 text-slate-400 rounded-full">5 min de lecture</span>
                    </div>
                    <h2 class="text-2xl font-bold mb-3 group-hover:text-indigo-400 transition-colors">L'art de la narration moderne</h2>
                    <p class="text-slate-400 text-sm leading-relaxed mb-6">
                        Pourquoi certains récits nous marquent-ils plus que d'autres ? Exploration des structures narratives qui captivent l'esprit...
                    </p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-orange-400 to-red-500"></div>
                            <span class="text-xs font-semibold">Jean-Paul S.</span>
                        </div>
                        <a href="#" class="text-sm font-bold border-b border-indigo-500 pb-1 hover:text-indigo-400 transition-all">Lire la suite</a>
                    </div>
                </div>
            </article>

            <article class="glass rounded-[2.5rem] overflow-hidden group hover:border-purple-500/50 transition-all duration-500">
                <div class="p-8">
                    <div class="flex gap-2 mb-4 text-[10px] uppercase tracking-widest font-bold">
                        <span class="px-3 py-1 bg-purple-500/20 text-purple-400 rounded-full">Philosophie</span>
                    </div>
                    <h2 class="text-2xl font-bold mb-3 group-hover:text-purple-400 transition-colors">Le silence dans le tumulte digital</h2>
                    <p class="text-slate-400 text-sm leading-relaxed mb-6">
                        Retrouver le goût de la concentration profonde dans un monde saturé de notifications...
                    </p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-blue-400 to-indigo-500"></div>
                            <span class="text-xs font-semibold">Marie Curie</span>
                        </div>
                        <a href="#" class="text-sm font-bold border-b border-purple-500 pb-1 hover:text-purple-400 transition-all">Lire la suite</a>
                    </div>
                </div>
            </article>
        </main>

        <aside class="hidden lg:block lg:w-1/4 space-y-6">
            <div class="glass p-6 rounded-[2rem]">
                <h4 class="text-sm font-bold uppercase tracking-widest mb-4">Tendances</h4>
                <ul class="space-y-4">
                    <li class="group cursor-pointer text-sm">
                        <p class="text-slate-500 group-hover:text-indigo-400 transition-colors">#Cyberpunk2077</p>
                        <span class="text-[10px] text-slate-600">2.4k lectures</span>
                    </li>
                    <li class="group cursor-pointer text-sm">
                        <p class="text-slate-500 group-hover:text-indigo-400 transition-colors">#Philosophie</p>
                        <span class="text-[10px] text-slate-600">1.8k lectures</span>
                    </li>
                </ul>
            </div>
        </aside>

    </div>

</body>
</html>