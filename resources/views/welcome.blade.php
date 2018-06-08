<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <title>{{ config('app.name', 'Laravel') }}</title> 
        <link rel="icon" href="/assets/images/">
        <meta name="author" content="">
        <link rel="stylesheet" type="text/css" href="/css/app.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta property="og:title" content="" />
        <meta property="og:site_name" content="" />
        <meta property="og:url" content="" /><!-- double check this one -->
        <meta property="og:description" content="" /><!-- add content -->
        <!--[if lt IE 8]><link rel="stylesheet" type="text/css" href="/assets/css/ie8.css"><![endif]-->
        
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
    </head>
    <body>
        <div class="bodyWrap flex">
            <header id="navigation">
                <div id="logo">
                    <a href="">
                        <img src="assets/images/Logo-White.svg" alt="">
                    </a>
                </div>
                <nav id="mainNav">
                    <ul>
                        <li>
                            <a href="">
                                <span class="icon">
                                    <i class="fas fa-circle"></i>
                                </span>
                                <span class="text">
                                    War Room
                                </span>
                                <span class="unreadNumber">50</span>
                            </a>
                            <ul>
                                <li class="active">
                                    <a href="">
                                        <span class="icon">
                                            <i class="fas fa-circle"></i>
                                        </span>
                                        <span class="text">
                                            War Room
                                        </span>
                                        <span class="unreadNumber">50</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <span class="icon">
                                            <i class="fas fa-circle"></i>
                                        </span>
                                        <span class="text">
                                            War Room
                                        </span>
                                        <span class="unreadNumber">50</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="">
                                <span class="icon">
                                    <i class="fas fa-circle"></i>
                                </span>
                                <span class="text">
                                    War Room
                                </span>
                                <span class="unreadNumber">50</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                <nav id="bottomNav">
                    <ul>
                        <li>
                            <a href="">
                                <i class="far fa-thumbs-up"></i>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <i class="fas fa-sticky-note"></i>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <i class="fas fa-heart" aria-hidden="true"></i>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <i class="fas fa-sign-out-alt" aria-hidden="true"></i>
                            </a>
                        </li>
                    </ul>
                </nav>
            </header>           

            <section id="middleColumn" class="">
                <div class="middleButton">
                    <div id="toggleMiddle" class="circle">
                        <i class="fas fa-caret-left"></i>
                    </div>
                </div>
                <div class="middleSurround">
                    <div class="stabilize">
                        <form action="">
                            <div id="search">
                                <div class="top">
                                    <input type="text">
                                    <div class="btn search" title="Search">
                                        <i class="fas fa-search"></i>
                                    </div>
                                    <div class="btn" title="Keyword Search Assistant">
                                        <i class="fas fa-question"></i>
                                    </div>
                                    <div class="btn yellow" title="Close Search">
                                        <i class="fas fa-chevron-circle-left"></i>
                                    </div>
                                </div>
                                <div class="bottom">
                                    <div class="left" id="openAdvancedSearch" title="Open Advanced Search">
                                        <i class="fas advanced fa-chevron-circle-down"></i><span>Advanced Search</span>
                                    </div>
                                    <div class="right">
                                        <i class="fas fa-exclamation-circle"></i><span>You are logged in!</span>
                                    </div>
                                </div>
                            </div>
                            <div id="advancedSearch">
                                <div class="scroll">
                                    
                                </div>
                            </div>
                        </form>
                        <div id="entries">
                            <div class="entryGroup">
                                <div class="entryGroupTitle">
                                    <span>Alerts from 1 Days Ago</span>
                                </div>
                                <div class="entry">
                                    <div class="entryContent">
                                        <a href="">
                                            <h2>YOUTUBE DOC – New Youtube Uploads -- 4/16/2018</h2>
                                        </a>
                                    </div>
                                    <div class="bar">
                                        <span class="text">Updated: 4.13.18 - 1:10 pm</span>
                                        <span class="buttons">
                                            <span class="button" title="">
                                                <i class="fas fa-trash"></i>
                                            </span>
                                            <span class="button" title="">
                                                <i class="fas fa-thumbs-up"></i>
                                            </span>
                                            <span class="button" title="">
                                                <i class="fas fa-envelope"></i>
                                            </span>
                                            <span class="button" title="">
                                                <i class="fas fa-heart"></i>
                                            </span>
                                            <span class="button" title="">
                                                <i class="fas fa-check-circle"></i>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                                <div class="entry active">
                                    <div class="entryContent">
                                        <a href="">
                                            <h2>YOUTUBE DOC – New Youtube Uploads -- 4/16/2018</h2>
                                        </a>
                                    </div>
                                    <div class="bar">
                                        <span class="text">Updated: 4.13.18 - 1:10 pm</span>
                                        <span class="buttons">
                                            <span class="button" title="">
                                                <i class="fas fa-trash"></i>
                                            </span>
                                            <span class="button" title="">
                                                <i class="fas fa-thumbs-up"></i>
                                            </span>
                                            <span class="button" title="">
                                                <i class="fas fa-envelope"></i>
                                            </span>
                                            <span class="button" title="">
                                                <i class="fas fa-heart"></i>
                                            </span>
                                            <span class="button" title="">
                                                <i class="fas fa-check-circle"></i>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="entryGroup">
                                <div class="entryGroupTitle">
                                    <span>Alerts from 2 Days Ago</span>
                                </div>
                                <div class="entry">
                                    <div class="entryContent">
                                        <a href="">
                                            <h2>YOUTUBE DOC – New Youtube Uploads -- 4/16/2018</h2>
                                        </a>
                                    </div>
                                    <div class="bar">
                                        <span class="text">Updated: 4.13.18 - 1:10 pm</span>
                                        <span class="buttons">
                                            <span class="button" title="">
                                                <i class="fas fa-trash"></i>
                                            </span>
                                            <span class="button" title="">
                                                <i class="fas fa-thumbs-up"></i>
                                            </span>
                                            <span class="button" title="">
                                                <i class="fas fa-envelope"></i>
                                            </span>
                                            <span class="button" title="">
                                                <i class="fas fa-heart"></i>
                                            </span>
                                            <span class="button" title="">
                                                <i class="fas fa-check-circle"></i>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                                <div class="entry">
                                    <div class="entryContent">
                                        <a href="">
                                            <h2>YOUTUBE DOC – New Youtube Uploads -- 4/16/2018</h2>
                                        </a>
                                    </div>
                                    <div class="bar">
                                        <span class="text">Updated: 4.13.18 - 1:10 pm</span>
                                        <span class="buttons">
                                            <span class="button" title="">
                                                <i class="fas fa-trash"></i>
                                            </span>
                                            <span class="button" title="">
                                                <i class="fas fa-thumbs-up"></i>
                                            </span>
                                            <span class="button" title="">
                                                <i class="fas fa-envelope"></i>
                                            </span>
                                            <span class="button" title="">
                                                <i class="fas fa-heart"></i>
                                            </span>
                                            <span class="button" title="">
                                                <i class="fas fa-check-circle"></i>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                                <div class="entry">
                                    <div class="entryContent">
                                        <a href="">
                                            <h2>YOUTUBE DOC – New Youtube Uploads -- 4/16/2018</h2>
                                        </a>
                                    </div>
                                    <div class="bar">
                                        <span class="text">Updated: 4.13.18 - 1:10 pm</span>
                                        <span class="buttons">
                                            <span class="button" title="">
                                                <i class="fas fa-trash"></i>
                                            </span>
                                            <span class="button" title="">
                                                <i class="fas fa-thumbs-up"></i>
                                            </span>
                                            <span class="button" title="">
                                                <i class="fas fa-envelope"></i>
                                            </span>
                                            <span class="button" title="">
                                                <i class="fas fa-heart"></i>
                                            </span>
                                            <span class="button" title="">
                                                <i class="fas fa-check-circle"></i>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                                <div class="entry">
                                    <div class="entryContent">
                                        <a href="">
                                            <h2>YOUTUBE DOC – New Youtube Uploads -- 4/16/2018</h2>
                                        </a>
                                    </div>
                                    <div class="bar">
                                        <span class="text">Updated: 4.13.18 - 1:10 pm</span>
                                        <span class="buttons">
                                            <span class="button" title="">
                                                <i class="fas fa-trash"></i>
                                            </span>
                                            <span class="button" title="">
                                                <i class="fas fa-thumbs-up"></i>
                                            </span>
                                            <span class="button" title="">
                                                <i class="fas fa-envelope"></i>
                                            </span>
                                            <span class="button" title="">
                                                <i class="fas fa-heart"></i>
                                            </span>
                                            <span class="button" title="">
                                                <i class="fas fa-check-circle"></i>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                                <div class="entry">
                                    <div class="entryContent">
                                        <a href="">
                                            <h2>YOUTUBE DOC – New Youtube Uploads -- 4/16/2018</h2>
                                        </a>
                                    </div>
                                    <div class="bar">
                                        <span class="text">Updated: 4.13.18 - 1:10 pm</span>
                                        <span class="buttons">
                                            <span class="button" title="">
                                                <i class="fas fa-trash"></i>
                                            </span>
                                            <span class="button" title="">
                                                <i class="fas fa-thumbs-up"></i>
                                            </span>
                                            <span class="button" title="">
                                                <i class="fas fa-envelope"></i>
                                            </span>
                                            <span class="button" title="">
                                                <i class="fas fa-heart"></i>
                                            </span>
                                            <span class="button" title="">
                                                <i class="fas fa-check-circle"></i>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                                <div class="entry">
                                    <div class="entryContent">
                                        <a href="">
                                            <h2>YOUTUBE DOC – New Youtube Uploads -- 4/16/2018</h2>
                                        </a>
                                    </div>
                                    <div class="bar">
                                        <span class="text">Updated: 4.13.18 - 1:10 pm</span>
                                        <span class="buttons">
                                            <span class="button" title="">
                                                <i class="fas fa-trash"></i>
                                            </span>
                                            <span class="button" title="">
                                                <i class="fas fa-thumbs-up"></i>
                                            </span>
                                            <span class="button" title="">
                                                <i class="fas fa-envelope"></i>
                                            </span>
                                            <span class="button" title="">
                                                <i class="fas fa-heart"></i>
                                            </span>
                                            <span class="button" title="">
                                                <i class="fas fa-check-circle"></i>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                                <div class="entry">
                                    <div class="entryContent">
                                        <a href="">
                                            <h2>YOUTUBE DOC – New Youtube Uploads -- 4/16/2018</h2>
                                        </a>
                                    </div>
                                    <div class="bar">
                                        <span class="text">Updated: 4.13.18 - 1:10 pm</span>
                                        <span class="buttons">
                                            <span class="button" title="">
                                                <i class="fas fa-trash"></i>
                                            </span>
                                            <span class="button" title="">
                                                <i class="fas fa-thumbs-up"></i>
                                            </span>
                                            <span class="button" title="">
                                                <i class="fas fa-envelope"></i>
                                            </span>
                                            <span class="button" title="">
                                                <i class="fas fa-heart"></i>
                                            </span>
                                            <span class="button" title="">
                                                <i class="fas fa-check-circle"></i>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="entryGroup">
                                <div class="entryGroupTitle">
                                    <span>Alerts from 3 Days Ago</span>
                                </div>
                                <div class="entry">
                                    <div class="entryContent">
                                        <a href="">
                                            <h2>YOUTUBE DOC – New Youtube Uploads -- 4/16/2018</h2>
                                        </a>
                                    </div>
                                    <div class="bar">
                                        <span class="text">Updated: 4.13.18 - 1:10 pm</span>
                                        <span class="buttons">
                                            <span class="button" title="">
                                                <i class="fas fa-trash"></i>
                                            </span>
                                            <span class="button" title="">
                                                <i class="fas fa-thumbs-up"></i>
                                            </span>
                                            <span class="button" title="">
                                                <i class="fas fa-envelope"></i>
                                            </span>
                                            <span class="button" title="">
                                                <i class="fas fa-heart"></i>
                                            </span>
                                            <span class="button" title="">
                                                <i class="fas fa-check-circle"></i>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                                <div class="entry">
                                    <div class="entryContent">
                                        <a href="">
                                            <h2>YOUTUBE DOC – New Youtube Uploads -- 4/16/2018</h2>
                                        </a>
                                    </div>
                                    <div class="bar">
                                        <span class="text">Updated: 4.13.18 - 1:10 pm</span>
                                        <span class="buttons">
                                            <span class="button" title="">
                                                <i class="fas fa-trash"></i>
                                            </span>
                                            <span class="button" title="">
                                                <i class="fas fa-thumbs-up"></i>
                                            </span>
                                            <span class="button" title="">
                                                <i class="fas fa-envelope"></i>
                                            </span>
                                            <span class="button" title="">
                                                <i class="fas fa-heart"></i>
                                            </span>
                                            <span class="button" title="">
                                                <i class="fas fa-check-circle"></i>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                                <div class="entry">
                                    <div class="entryContent">
                                        <a href="">
                                            <h2>YOUTUBE DOC – New Youtube Uploads -- 4/16/2018</h2>
                                        </a>
                                    </div>
                                    <div class="bar">
                                        <span class="text">Updated: 4.13.18 - 1:10 pm</span>
                                        <span class="buttons">
                                            <span class="button" title="">
                                                <i class="fas fa-trash"></i>
                                            </span>
                                            <span class="button" title="">
                                                <i class="fas fa-thumbs-up"></i>
                                            </span>
                                            <span class="button" title="">
                                                <i class="fas fa-envelope"></i>
                                            </span>
                                            <span class="button" title="">
                                                <i class="fas fa-heart"></i>
                                            </span>
                                            <span class="button" title="">
                                                <i class="fas fa-check-circle"></i>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                                <div class="entry">
                                    <div class="entryContent">
                                        <a href="">
                                            <h2>YOUTUBE DOC – New Youtube Uploads -- 4/16/2018</h2>
                                        </a>
                                    </div>
                                    <div class="bar">
                                        <span class="text">Updated: 4.13.18 - 1:10 pm</span>
                                        <span class="buttons">
                                            <span class="button" title="">
                                                <i class="fas fa-trash"></i>
                                            </span>
                                            <span class="button" title="">
                                                <i class="fas fa-thumbs-up"></i>
                                            </span>
                                            <span class="button" title="">
                                                <i class="fas fa-envelope"></i>
                                            </span>
                                            <span class="button" title="">
                                                <i class="fas fa-heart"></i>
                                            </span>
                                            <span class="button" title="">
                                                <i class="fas fa-check-circle"></i>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                                <div class="entry">
                                    <div class="entryContent">
                                        <a href="">
                                            <h2>YOUTUBE DOC – New Youtube Uploads -- 4/16/2018</h2>
                                        </a>
                                    </div>
                                    <div class="bar">
                                        <span class="text">Updated: 4.13.18 - 1:10 pm</span>
                                        <span class="buttons">
                                            <span class="button" title="">
                                                <i class="fas fa-trash"></i>
                                            </span>
                                            <span class="button" title="">
                                                <i class="fas fa-thumbs-up"></i>
                                            </span>
                                            <span class="button" title="">
                                                <i class="fas fa-envelope"></i>
                                            </span>
                                            <span class="button" title="">
                                                <i class="fas fa-heart"></i>
                                            </span>
                                            <span class="button" title="">
                                                <i class="fas fa-check-circle"></i>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                                <div class="entry">
                                    <div class="entryContent">
                                        <a href="">
                                            <h2>YOUTUBE DOC – New Youtube Uploads -- 4/16/2018</h2>
                                        </a>
                                    </div>
                                    <div class="bar">
                                        <span class="text">Updated: 4.13.18 - 1:10 pm</span>
                                        <span class="buttons">
                                            <span class="button" title="">
                                                <i class="fas fa-trash"></i>
                                            </span>
                                            <span class="button" title="">
                                                <i class="fas fa-thumbs-up"></i>
                                            </span>
                                            <span class="button" title="">
                                                <i class="fas fa-envelope"></i>
                                            </span>
                                            <span class="button" title="">
                                                <i class="fas fa-heart"></i>
                                            </span>
                                            <span class="button" title="">
                                                <i class="fas fa-check-circle"></i>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </section>
                        
            <section id="rightColumn">
                <div id="topBar">
                    <div class="left">
                        <span id="title">Print Alert</span>
                        <span class="button">
                            <i class="fas fa-step-backward"></i>
                        </span>
                        <span class="button">
                            <i class="fas fa-step-forward"></i>
                        </span>
                    </div>
                    <div class="right">
                        <span class="button">
                            <i class="fas fa-edit"></i>
                        </span>
                        <span class="button">
                            <i class="fas fa-search-plus"></i>
                        </span>
                        <span class="button">
                            <i class="fas fa-search-minus"></i>
                        </span>
                        <span class="button">
                            <i class="fas fa-envelope"></i>
                        </span>
                        <span class="button">
                            <i class="fas fa-print"></i>
                        </span>
                        <span class="button">
                            <i class="far fa-heart"></i>
                        </span>
                    </div>
                </div>
                <div id="mainContent">
                    <div id="content" class="view">
                        
                    </div>
                </div>
            </section>

            <footer>

                <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
                <script src="assets/js/script.js"></script>
            </footer>
        </div><!-- /.bodyWrap -->
    </body>
</html>
