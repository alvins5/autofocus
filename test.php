<?php phpinfo(); ?>
*{
    margin: 0%;
    padding: 0%;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
    color: white;
    scroll-behavior: smooth;
}

body{
    background-color: #232323;
    overflow-x:hidden ;
}

.header{
    height: 100vh;
    width: 100%;
}

.navbar{
    padding: 15px 18px !important;
    background-color: #131313ab;
}

.logo{
    font-weight: 600;
    color: rgba(255, 255, 255, 0.848) !important;
}

.nav-item{
    margin: 0px 10px;
}

.nav-item .nav-link{
    color: rgba(255, 255, 255, 0.92);
    font-size: 14px;
    font-weight: 500;
    position: relative;
}

.nav-link::after{
    content: '';
    position: absolute;
    bottom: -1px;
    left: 0px;
    background-color: rgb(196, 255, 58);
    width: 0%;
    height: 3px;
    transition: 0.4s ease-in-out;
}

.nav-item:hover .nav-link::after{
    width: 100%;

}

.nav-link:hover{
    color:rgb(196, 255, 58);
}

.btn-navbar{
    display: inline-block;
    padding: 10px 30px;
    border: 1px solid rgb(36, 193, 255);
    color: white;
    border-radius: 50px;
    text-decoration: none;
    font-size: 14px;
    font-weight: 600;
    background-color: rgb(36, 193, 255);
    transition: 0.2s ease;
    margin: 0 5px 0 5px;
}

.btn-navbar:hover{
    background-color: transparent;
    color: rgb(196, 255, 58);
    border: 1px solid rgb(196, 255, 58);
}

.navbar-toggler{
    border: none;
    color: white;
}    

.navbar-toggler:hover{
    color: transparent
}

.navbar-toggler-icon {
    background-image: url('data:image/svg+xml;charset=utf8,<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30"><path fill="%23fff" d="M5 7h20c1.1 0 2-.9 2-2s-.9-2-2-2H5c-1.1 0-2 .9-2 2s.9 2 2 2zm0 8h20c1.1 0 2-.9 2-2s-.9-2-2-2H5c-1.1 0-2 .9-2 2s.9 2 2 2zm0 8h20c1.1 0 2-.9 2-2s-.9-2-2-2H5c-1.1 0-2 .9-2 2s.9 2 2 2z"/></svg>');
    background-repeat: no-repeat;
    background-position: center;
    background-size: contain;
    border: none;
    width: 30px; 
    height: 30px; 
}
/* home section start */

.content-home{
    margin-top: 100px;
}

.content-home2{
    height: 90vh;
    width: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.home-heading{
    font-size: 50px;
    font-weight: 700;
    line-height: 74px;
}

.home-span{
    color: rgb(196, 255, 58);
}

.para-home{
    font-size: 13px;
    font-weight: 500;
    color: rgba(255, 255, 255, 0.42);
    max-width: 400px;
    line-height: 24px;
    margin: 14px 0px;
}

.home-links{
    display: inline-block;
    text-decoration: none;
    color: white;
    border: 1px solid rgb(36, 193, 255);
    background-color: rgb(36, 193, 255);
    margin: 20px 0px;
    margin-right: 7px;
    border-radius: 50px;
    padding: 10px 37px;
    font-size: 14px;
    font-weight: 600;
    transition: 0.2s ease;

}

.btn-2{
    border: 1px solid rgb(36, 193, 255);
    color: rgb(36, 193, 255);
    background-color: transparent;
}

.home-links:hover{
    background-color: transparent;
    color: rgb(196, 255, 58);
    border: 1px solid rgb(196, 255, 58) !important;
}

.img-home{
    margin-top: 50px;
    width: 580px;
    border-radius: 20px;
    box-shadow: 0 6px 31px -2px rgba(75, 74, 74, 0.1);
}

/* about Section CSS*/

.about-us-container{
    width: 100%;
    height: 80vh;
}

.about-us{
    width: 100%;
    height: 320px;
    background-color: rgb(54, 54, 54);
    margin-top: 120px;
    position: relative;
}

.content-about{
    padding: 10px 38px;
}

.heading-about{
    font-size: 30px;
    font-weight: bold;
    letter-spacing: 1px;
    color: rgb(196, 255, 58);
    margin: 10px 0px;
    margin-bottom: 34px;
    position: relative;
}

.heading-about:after{
    content: '';
    position: absolute;
    left: 0px;
    bottom: -8px;
    background-color: rgb(196, 255, 58);
    width: 46px;
    height: 2px;
}

.para-about{
    font-size: 13px;
    font-weight: 500;
    color: rgba(255, 255, 255, 0.695);
    line-height: 21px;
    margin: 25px 0px;
}

.link-about{
    text-decoration: none;
    text-transform: uppercase;
    border: 1px solid rgb(196, 255, 58);
    color: rgb(196, 255, 58);
    display: inline-block;
    font-size: 11px;
    font-weight: 600;
    padding: 8px 22px;
    position: relative;
    z-index: 22;
}

.link-about:hover{
    color: white;
    transition: 0.3s ease-in;
}

.span-about{
    position: absolute;
    top: 0px;
    left: 0px;
    background-color: rgb(196, 255, 58);
    width: 0%;
    height: 100%;
    z-index: -1;
    transition: 0.4s ease-in;
}

.link-about:hover .span-about{
    width: 100%;
}

.fa-arrow-right{
    color: rgb(196, 255, 58);
    font-size: 11px;
    margin-left: 5px;
}

.fa-arrow-right:hover{
    color: white;
    transition: 0.3s ease-in;
}

.img-about{
    height: 420px;
    width: 40%;
    position: absolute;
    top: -36px;
    right: 20px;
    border-radius: 10px;
}

.flexible{
    display: flex;
    flex-flow: row wrap;
    justify-content: center;
    align-content: center;
    text-align: start;
    flex: 1;
}

.section-heading{
    text-align: center;
    font-size: 2rem;
    padding: 1rem;
    margin-top: 40px;
    position: static;
}


.sec-padding{
    padding: 10rem 0 10rem 0;
}


.tile{
    background-color: transparent;
    height: 35rem;
    width: 25rem;
    transition: all 0.2s;
    /* padding: 1.5rem; */
    margin: 1.5rem;
    font-size: 17.50px;
    text-align: start;

}

.tile:hover{
    transform: scale(1.05);
}

.tile img{
    width: 100%;
    max-width: 48rem;
    border-radius: 50px;
}

.footer{
    width: 100%;
    height: auto;
    padding: 50px 0  0 0;
    text-align: center;
}
.footer h3{
    text-align: center;
    font-size: 25px;
    padding-bottom: 10px;
    border-bottom: 2px solid rgb(196, 255, 58);
    display: inline-block;
    margin-bottom: 50px;
}
.footer p{
    font-size: 18px;
    width: 600;
    color: rgba(255, 255, 255, 0.9);
    padding: 0 10px;
}

iframe{
    border-radius: 30px;
}

.Copyright h4{
    font-size: 14px;
    line-height: 100px;
}

.contact2:hover{
    color: rgb(196, 255, 58);
}

.wa{
    color: greenyellow;
    font-size: 35px;
}

.location2:hover{
    color: rgb(196, 255, 58);
}

/* Media queries for different screen sizes */

/* For tablets in portrait mode and mobile devices */
@media (max-width: 768px) {
    .header {
        height: auto;
    }

    .content-home2 {
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    .img-home {
        width: 100%;
        margin: 0;
    }

    .home-heading {
        font-size: 35px;
        line-height: 50px;
    }

    .para-home {
        font-size: 12px;
        max-width: 100%;
    }

    .btn-home {
        flex-direction: column;
    }

    .home-links {
        margin-right: 0;
        margin-bottom: 10px;
    }

    .img-about {
        width: 100%;
        height: auto;
        position: static;
        margin: 20px 0;
    }

    .about-us {
        height: auto;
        padding: 20px;
    }

    .footer iframe {
        width: 100%;
        height: 200px;
    }

    .tile {
        width: 100%;
        max-width: 400px;
        margin: 0.5rem auto;
    }
}

/* For mobile devices in landscape mode */
@media (min-width: 769px) and (max-width: 992px) {
    .content-home2 {
        flex-direction: column;
        text-align: center;
    }

    .img-home {
        width: 100%;
        margin: 0 auto;
    }

    .home-heading {
        font-size: 40px;
        line-height: 60px;
    }

    .para-home {
        font-size: 13px;
        max-width: 90%;
    }

    .btn-home {
        flex-direction: column;
    }

    .home-links {
        margin-right: 0;
        margin-bottom: 10px;
    }

    .img-about {
        width: 100%;
        height: auto;
        position: static;
        margin: 20px 0;
    }

    .tile {
        width: 100%;
        max-width: 350px;
        margin: 0.5rem auto;
    }
}

/* For large screens (desktops) */
@media (min-width: 993px) {
    .navbar-toggler {
        display: flex;
    }
    

    .content-home2 {
        flex-direction: row;
    }

    .img-home {
        width: 580px;
    }

    .home-heading {
        font-size: 50px;
        line-height: 74px;
    }

    .btn-home {
        display: flex;
    }

    .about-us {
        height: 320px;
    }

    .img-about {
        height: 420px;
        width: 40%;
        position: absolute;
    }

    .tile {
        width: 25rem;
        height: 40rem;
    }
}
