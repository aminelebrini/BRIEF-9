<?php 
    use Controllers\AuthentificationController;
    use Controllers\AuthorController;
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
        /*.sidebar-item-active { background: linear-gradient(to right, rgba(139, 92, 246, 0.2), transparent); border-left: 4px solid #8b5cf6; }*/
        .blob { filter: blur(80px); position: fixed; z-index: 0; pointer-events: none; }
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-thumb { background: rgba(255, 255, 255, 0.1); border-radius: 10px; }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .article-card {
            animation: fadeInUp 0.4s ease-out forwards;
            cursor: pointer;
        }

        .line-clamp-1 {
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .article-card:hover {
            border-color: rgba(139, 92, 246, 0.3);
            box-shadow: 0 10px 30px -10px rgba(139, 92, 246, 0.15);
        }
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
            
            <a id="ensemble" class="sidebar-item-active flex items-center gap-4 px-4 py-4 rounded-xl text-purple-400 font-bold transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                Vue d'ensemble
            </a>

            <a id="articlelist" class="flex items-center gap-4 px-4 py-4 rounded-xl text-slate-400 hover:bg-white/5 hover:text-white transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                Mes Articles
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

    <main class="display1 flex-1 ml-72 p-12 relative z-10">
    
        <div class="flex justify-between items-center mb-12">
            <div>
                <h2 class="text-4xl font-black">Bonjour, <?= htmlspecialchars($_SESSION['user']['first_name'] . " " . $_SESSION['user']['last_name']) ?> 👋</h2>
                <p class="text-slate-500 text-sm mt-2 font-medium italic">Prêt à inspirer vos lecteurs aujourd'hui ?</p>
            </div>
            <div class="flex gap-4">
                <button id="ecriver" class="bg-purple-600 px-6 py-2.5 rounded-xl text-xs font-bold hover:bg-purple-500 transition-all uppercase tracking-widest shadow-lg shadow-purple-900/40">Écrire</button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <div class="glass p-8 rounded-[2rem] border-l-4 border-purple-500">
                <p class="text-slate-500 text-xs font-bold uppercase tracking-widest">Articles publiés</p>
                <h3 class="text-4xl font-black mt-2"><?= count($AllArticle) ?></h3>
            </div>
            <div class="glass p-8 rounded-[2rem] border-l-4 border-blue-500">
                <p class="text-slate-500 text-xs font-bold uppercase tracking-widest">Likes totales</p>
                <h3 class="text-4xl font-black mt-2">22</h3>
            </div>
            <div class="glass p-8 rounded-[2rem] border-l-4 border-pink-500">
                <p class="text-slate-500 text-xs font-bold uppercase tracking-widest">Commentaires reçus</p>
                <h3 class="text-4xl font-black mt-2"><?= count($Commentaires) ?></h3>
            </div>
        </div>

     <div class="grid lg:grid-cols-12 gap-10 items-start">
        
            <div class="lg:col-span-8">
                <h3 class="text-xl font-bold mb-6 flex items-center gap-3">
                    <span class="w-1.5 h-6 bg-purple-500 rounded-full"></span>
                    Mes Publications
                </h3>
            
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <?php foreach($AllArticle as $article): ?>
                        <?php if ($article['author_id'] == $_SESSION['user']['id']): ?>
                        <div class="glass group p-6 rounded-[2.5rem] border border-white/5 hover:border-purple-500/30 hover:bg-white/[0.04] transition-all duration-500 flex flex-col justify-between h-auto">
                         <div class="flex-1 overflow-hidden">
                                <h3 class="text-[30px] font-bold text-white leading-tight group-hover:text-purple-300 transition-colors">
                                    <?= htmlspecialchars($article['titre']) ?>
                                </h3>
                                <p class="text-slate-400 text-[25px] mt-3 line-clamp-3 font-light leading-relaxed">
                                    <?= strip_tags($article['contenu']) ?>
                                </p>
                                <p class="text-slate-400 text-[15px] mt-3 line-clamp-3 font-light leading-relaxed">
                                    <?= strip_tags($article['date_publication']) ?>
                                </p>
                            </div>
                        </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>

         <div class="lg:col-span-4 sticky top-12">
             <div class="glass p-8 rounded-[2.5rem] bg-gradient-to-br from-purple-600/10 to-transparent border border-purple-500/20">
                    <h3 class="font-bold mb-4 flex items-center gap-2">
                        <span class="text-xl">💡</span> Astuce d'écriture
                    </h3>
                    <p class="text-sm text-slate-400 leading-relaxed italic">
                        "Les articles avec une image de couverture percutante reçoivent en moyenne 40% de clics en plus. Pensez à soigner vos visuels !"
                    </p>
                    <div class="mt-6 pt-6 border-t border-white/10">
                        <p class="text-[10px] text-slate-500 uppercase font-bold tracking-widest">Le saviez-vous ?</p>
                        <p class="text-xs text-slate-400 mt-2">La régularité est la clé pour fidéliser votre audience sur ReadUp.</p>
                    </div>
                </div>
            </div>

        </div>
    </main>
    <main class="Display2 hidden flex-1 ml-72 p-12 relative z-10">
    <div class="max-w-5xl mx-auto">
        <h3 class="text-xl font-bold mb-8 flex items-center gap-3">
            <span class="w-1.5 h-6 bg-purple-500 rounded-full"></span>
            Flux des Articles
        </h3>

        <div class="space-y-4">
            <?php foreach($AllArticle as $article): ?>
            <article class="article-card glass group p-6 rounded-[2rem] border border-white/5 flex items-center gap-6 hover:bg-white/[0.04] transition-all duration-300">
                <div class="hidden md:flex flex-col items-center justify-center border-r border-white/10 pr-6 min-w-[80px]">
                    <span class="text-2xl font-black text-white"><?= $article['id'] ?></span>
                </div>

                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-2">
                        <span class="text-[10px] px-2 py-0.5 rounded bg-purple-500/20 text-purple-400 font-bold uppercase tracking-widest">Technologie</span>
                    </div>
                    <h3 class="text-[30px] font-bold text-white leading-tight group-hover:text-purple-300 transition-colors">
                        <?= htmlspecialchars($article['titre']) ?>
                    </h3>                    
                    <p class="text-sm text-slate-400 mt-1 line-clamp-1"><?= $article['contenu'] ?></p>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
    </div>
</main>
    <div id="modalEcri" class="fromecri glass p-10 shadow-2xl shadow-purple-900/40 hidden border border-white/10 rounded-[3rem] fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-[100] w-[95%] max-w-4xl max-h-[90vh] overflow-y-auto">
    
    <div class="flex justify-end mb-2">
        <button id="closeBtn" class="text-slate-500 hover:text-white transition-colors p-2">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
    </div>

    <div class="max-w-4xl mx-auto">
        <div class="mb-10">
            <h2 class="text-3xl font-black text-white">Nouvelle <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-pink-500">Publication</span></h2>
            <p class="text-slate-500 text-sm">Partagez vos idées avec la communauté ReadUp.</p>
        </div>

        <form id="articleForm" method="POST" action="/addArticle" class="space-y-8">
            
            <div class="grid grid-cols-1 gap-6">
                <div class="glass p-8 rounded-[2rem] focus-within:border-purple-500/50 transition-all">
                    <label class="text-[10px] uppercase font-black text-purple-400 tracking-[0.2em] mb-4 block">Titre de l'oeuvre</label>
                    <input type="text" name="title" required 
                        placeholder="Entrez un titre percutant..." 
                        class="w-full bg-transparent border-none text-2xl font-bold text-white placeholder:text-white focus:outline-none">
                </div>

                <div class="glass p-8 rounded-[2rem] focus-within:border-purple-500/50 transition-all">
                    <label class="text-[10px] uppercase font-black text-purple-400 tracking-[0.2em] mb-4 block">Corps de l'article</label>
                    <textarea name="content" required rows="10" 
                        placeholder="Il était une fois..." 
                        class="w-full bg-transparent border-none text-slate-300 leading-relaxed placeholder:text-white focus:outline-none resize-none"></textarea>
                </div>
            </div>

            <div class="flex justify-center pt-4">
                <button type="submit" name="pub" value="<?= $_SESSION['user']['id'] ?>" class="bg-gradient-to-r from-purple-600 to-pink-600 px-12 py-4 rounded-2xl text-xs font-black text-white hover:scale-105 transition-all uppercase tracking-widest shadow-lg shadow-purple-900/40">
                    Publier l'article
                </button>
            </div>
        </form>
    </div>
    
    <!--2 modifier-->

    <div id="modalEcri" class="fromecri glass p-10 shadow-2xl shadow-purple-900/40 hidden border border-white/10 rounded-[3rem] fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-[100] w-[95%] max-w-4xl max-h-[90vh] overflow-y-auto">
    
    <div class="flex justify-end mb-2">
        <button id="closeBtn" class="text-slate-500 hover:text-white transition-colors p-2">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
    </div>

    <div class="max-w-4xl mx-auto">
            <div class="mb-10">
                <h2 class="text-3xl font-black text-white">Nouvelle <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-pink-500">Publication</span></h2>
                <p class="text-slate-500 text-sm">Partagez vos idées avec la communauté ReadUp.</p>
            </div>

            <form id="articleForm" method="POST" action="/addArticle" class="space-y-8">
            
                <div class="grid grid-cols-1 gap-6">
                    <div class="glass p-8 rounded-[2rem] focus-within:border-purple-500/50 transition-all">
                        <label class="text-[10px] uppercase font-black text-purple-400 tracking-[0.2em] mb-4 block">Titre de l'oeuvre</label>
                        <input type="text" name="title" required 
                            placeholder="Entrez un titre percutant..." 
                            class="w-full bg-transparent border-none text-2xl font-bold text-white placeholder:text-white focus:outline-none">
                    </div>

                    <div class="glass p-8 rounded-[2rem] focus-within:border-purple-500/50 transition-all">
                        <label class="text-[10px] uppercase font-black text-purple-400 tracking-[0.2em] mb-4 block">Corps de l'article</label>
                        <textarea name="content" required rows="10" 
                            placeholder="Il était une fois..." 
                            class="w-full bg-transparent border-none text-slate-300 leading-relaxed placeholder:text-white focus:outline-none resize-none"></textarea>
                    </div>
                </div>

                <div class="flex justify-center pt-4">
                    <button type="submit" name="modif" value="<?= $_SESSION['article']['id'] ?>" class="bg-gradient-to-r from-purple-600 to-pink-600 px-12 py-4 rounded-2xl text-xs font-black text-white hover:scale-105 transition-all uppercase tracking-widest shadow-lg shadow-purple-900/40">
                        MOdifier l'article
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div id="overlay" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[45] hidden"></div>
    <script>
const CloseBtn = document.getElementById('closeBtn');
const FormEcri  = document.querySelector('.fromecri');
const EciBtn = document.getElementById('ecriver');
const ArticleBtn = document.getElementById('articlelist');
const EnsembleBtn = document.getElementById('ensemble');
const Display1 = document.querySelector('.display1');
const Display2 = document.querySelector('.Display2');

if (EciBtn) {
    EciBtn.addEventListener('click', ()=>{
        FormEcri.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    });
}

if (CloseBtn) {
    CloseBtn.addEventListener('click', ()=>{
        FormEcri.classList.add('hidden');
        document.body.style.overflow = 'auto';
    });
}

if (ArticleBtn) {
    ArticleBtn.addEventListener('click', ()=>{
        Display1.classList.add('hidden');
        Display2.classList.remove('hidden');
    });
}
if(EnsembleBtn)
{
    EnsembleBtn.addEventListener('click', ()=>{
        Display1.classList.remove('hidden');
        Display2.classList.add('hidden');
    });
}
</script>

</body>
</html>