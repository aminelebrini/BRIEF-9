<?php

    use Controllers\AuthentificationController;
    use Controllers\AuthorController;
    use Controllers\ReaderController;
    use Controllers\DisplayController;

    $User = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
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
                        <?php $userLikesCount = 0;
                        foreach($Likes as $like): ?>
                            <?php if($like['user_id'] === $User['id']): 
                                $userLikesCount++;?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                            <span class="font-bold"><?= $userLikesCount; ?></span>
                    </div>
                </div>

                <button class="w-full mt-6 py-3 rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 text-sm font-bold hover:opacity-90 transition-all">
                    Éditer le profil
                </button>
                <form action="/logout" method="POST" class="mt-3">
                    <button type="submit" name="logout" class="w-full py-3 rounded-xl glass border border-red-500/20 text-red-400 text-[10px] font-bold uppercase tracking-widest hover:bg-red-500/10 hover:border-red-500/50 transition-all duration-300 flex items-center justify-center gap-2">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                            Déconnexion
                    </button>
                </form>
            </div>
        </aside>

        <main class="lg:w-2/4 space-y-8 pb-20">
        <?php foreach($AllArticle as $article):?>
            
            <article class="glass rounded-3xl overflow-hidden border border-white/10 mb-8 max-w-2xl mx-auto transition-all hover:bg-white/[0.02]">
    
                <div class="p-5 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-tr from-indigo-500 to-purple-500 p-0.5">
                            <div class="w-full h-full rounded-full bg-[#0b0f1a] flex items-center justify-center overflow-hidden">
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTtuphMb4mq-EcVWhMVT8FCkv5dqZGgvn_QiA&s" alt="Avatar">
                            </div>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-white flex items-center gap-1">
                                <?= $article['first_name'] . " " . $article['last_name'] ?>
                                <svg class="w-3 h-3 text-blue-400" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293l-4 4a1 1 0 01-1.414 0l-2-2a1 1 0 111.414-1.414L9 10.586l3.293-3.293a1 1 0 111.414 1.414z"></path></svg>
                            </h3>
                            <p class="text-[11px] text-slate-500 font-medium italic"><?= $article['date_publication'] ?></p>
                        </div>
                    </div>
                </div>

                <div class="px-5 pb-4">
                    <h2 class="text-xl font-bold mb-2 text-indigo-400"><?= $article['titre'] ?></h2>
                    <p class="text-slate-300 text-sm leading-relaxed">
                        <?= $article['contenu'] ?>
                    </p>
                </div>
                <div class="px-5 py-3 border-t border-white/5 bg-white/[0.01]">
                    <div class="flex items-center justify-between">
                        <div class="flex gap-6">
                            <div class="flex gap-6">
                                <div class="flex items-center gap-2">
                                    <form method="POST" action="/liker_article">
                                        <input type="hidden" name="user_id" value="<?= $User['id'] ?>">
                                        <input type="hidden" name="article_id" value="<?= $article['id'] ?>">
                                        <button name="like" type="submit" id="like" class="flex items-center text-slate-400 hover:text-indigo-400 transition-all group"><i class="fa-regular fa-heart text-lg"></i></button>
                                    </form>
                                    <?php $likesCount = 0;?>
                                    <?php foreach($Likes as $like): ?>
                                        <?php if($article['id'] === $like['article_id']){ 
                                            $likesCount++;?>
                                        <?php } ?>
                                    <?php endforeach; ?>
                                        <span class="text-xs font-bold uppercase tracking-widest text-slate-400"><?= $likesCount; ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
            <?php endforeach; ?>
        </main>

        <aside class="hidden lg:block lg:w-1/4 space-y-6 lg:top-24">
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