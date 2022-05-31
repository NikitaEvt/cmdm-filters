<?php $this->load->view("layouts/header/slider"); ?>

<div class="bg-gray-theme pt-0 rounded-b-bg px-7 pb-16">
    <div class="flex justify-center items-center text-center pb-16">
        <svg class="inline-block" width="30" height="28" viewBox="0 0 30 28" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M15 0L18.3677 10.3647H29.2658L20.4491 16.7705L23.8168 27.1353L15 20.7295L6.18322 27.1353L9.55093 16.7705L0.734152 10.3647H11.6323L15 0Z" fill="#3597D0" />
        </svg>
        <span class="text-4xl pl-2 pr-0 sm:pr-8">Самые популярные</span>
        <a class="py-2.5 px-6 border border-sky-theme border-solid rounded-full text-sm" href="/<?= $lclang ?>/<?= $menu['all'][2]->uri ?>">
            <span class="pr-8">Перейти в каталог</span>
            <svg class="inline-block" width="30" height="9" viewBox="0 0 30 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M29.8536 4.85355C30.0488 4.65829 30.0488 4.34171 29.8536 4.14645L26.6716 0.964466C26.4763 0.769204 26.1597 0.769204 25.9645 0.964466C25.7692 1.15973 25.7692 1.47631 25.9645 1.67157L28.7929 4.5L25.9645 7.32843C25.7692 7.52369 25.7692 7.84027 25.9645 8.03553C26.1597 8.2308 26.4763 8.2308 26.6716 8.03553L29.8536 4.85355ZM0 5H29.5V4H0V5Z" fill="#303030" />
            </svg>
        </a>
    </div>

    <div class="home-product-slider">
        <div>
            <div class="bg-white rounded-card p-3.5 border-2 border-white border-solid hover:border-2 shadow-card hover:border-gray-200 mx-3">
                <div class="flex justify-between items-center pb-3.5 px-2.5">
                    <h5 class="text-xl">2.650 MDL</h5>
                    <span class="text-sky-theme text-sm line-through">3.000 MDL</span>
                </div>
                <img class="object-cover w-full h-40" src="/assets/img/front/rectangleCart2.png" alt="">
                <div class="flex justify-between items-center text-sm text-gray-400 pt-3.5">
                    <h5 class="uppercase">GROHE</h5>
                    <span>Art. 28512001</span>
                </div>
                <h2 class="text-lg leading-6 text-gray-900 pt-2">Setul dușului igienic Grohe Bau Edge</h2>
                <div class="flex justify-between pt-7">
                    <a href="#" class="bg-sky-theme rounded-xl py-3 px-8 w-full mr-2.5 text-center text-white text-sm leading-normal">
                        <i class="fas fa-shopping-cart pr-2"></i>
                        В корзину
                    </a>
                    <a href="#" class="w-[50px] text-center border border-solid border-gray-300 rounded-xl px-3 py-2.5 text-sky-theme flex items-center">
                        <svg width="24" height="19" viewBox="0 0 24 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.7836 17.7828L3.0461 10.1313C2.11506 9.3473 1.47049 8.37518 1.18401 7.34033C0.897537 6.36821 0.897537 5.30201 1.29144 4.2358C1.64953 3.29504 2.25829 2.4797 3.0461 1.78981C3.86971 1.09991 4.83657 0.566812 5.91085 0.284582C7.16418 -0.0603659 8.4175 -0.0917247 9.5634 0.190505C10.6019 0.441376 11.5687 0.880401 12.4282 1.50758C13.2876 0.880401 14.2544 0.441376 15.2929 0.190505C16.4388 -0.0603659 17.6921 -0.0603659 18.9455 0.284582C20.0197 0.566812 20.9866 1.09991 21.8102 1.78981C22.598 2.4797 23.2426 3.29504 23.5649 4.2358C23.9588 5.30201 23.9946 6.36821 23.6723 7.34033C23.35 8.37518 22.7054 9.31594 21.7744 10.1313L21.7386 10.1626L13.0369 17.7828C12.7146 18.0964 12.1417 18.0964 11.7836 17.7828ZM13.4666 2.76193L10.6735 5.23929C10.4586 5.42744 10.1364 5.42744 9.9215 5.23929C9.70664 5.05113 9.70664 4.7689 9.9215 4.58075L11.712 3.01281L11.6762 2.98145C10.9242 2.35427 10.0647 1.88389 9.13369 1.66437C8.27426 1.47622 7.37903 1.47622 6.44799 1.72709C5.66018 1.9466 4.90819 2.35427 4.29943 2.88737C3.69067 3.38911 3.22515 4.04765 2.97448 4.73755C2.68801 5.52152 2.6522 6.27413 2.86705 6.96403C3.08191 7.71664 3.58324 8.43789 4.29943 9.06507L12.4282 16.1522L20.5211 9.06507L20.5569 9.03371C21.2731 8.40654 21.7744 7.71664 21.9893 6.93267C22.2041 6.24277 22.2041 5.49016 21.8818 4.70619C21.5953 4.01629 21.1298 3.38911 20.5569 2.85601C19.9481 2.32291 19.1961 1.91524 18.4083 1.69573C17.4773 1.44486 16.582 1.44486 15.7584 1.63301C14.9348 1.88389 14.147 2.26019 13.4666 2.76193Z" fill="#3597D0" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        <div>
            <div class="bg-white rounded-card p-3.5 border-2 border-white border-solid hover:border-2 shadow-card hover:border-gray-200 mx-3">
                <div class="flex justify-between items-center pb-3.5 px-2.5">
                    <h5 class="text-xl">2.650 MDL</h5>
                    <span class="text-sky-theme text-sm line-through">3.000 MDL</span>
                </div>
                <img class="object-cover w-full h-40" src="/assets/img/front/rectangleCart2.png" alt="">
                <div class="flex justify-between items-center text-sm text-gray-400 pt-3.5">
                    <h5 class="uppercase">GROHE</h5>
                    <span>Art. 28512001</span>
                </div>
                <h2 class="text-lg leading-6 text-gray-900 pt-2">Setul dușului igienic Grohe Bau Edge</h2>
                <div class="flex justify-between pt-7">
                    <a href="#" class="bg-sky-theme rounded-xl py-3 px-8 w-full mr-2.5 text-center text-white text-sm leading-normal">
                        <i class="fas fa-shopping-cart pr-2"></i>
                        В корзину
                    </a>
                    <a href="#" class="w-[50px] text-center border border-solid border-gray-300 rounded-xl px-3 py-2.5 text-sky-theme flex items-center">
                        <svg width="24" height="19" viewBox="0 0 24 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.7836 17.7828L3.0461 10.1313C2.11506 9.3473 1.47049 8.37518 1.18401 7.34033C0.897537 6.36821 0.897537 5.30201 1.29144 4.2358C1.64953 3.29504 2.25829 2.4797 3.0461 1.78981C3.86971 1.09991 4.83657 0.566812 5.91085 0.284582C7.16418 -0.0603659 8.4175 -0.0917247 9.5634 0.190505C10.6019 0.441376 11.5687 0.880401 12.4282 1.50758C13.2876 0.880401 14.2544 0.441376 15.2929 0.190505C16.4388 -0.0603659 17.6921 -0.0603659 18.9455 0.284582C20.0197 0.566812 20.9866 1.09991 21.8102 1.78981C22.598 2.4797 23.2426 3.29504 23.5649 4.2358C23.9588 5.30201 23.9946 6.36821 23.6723 7.34033C23.35 8.37518 22.7054 9.31594 21.7744 10.1313L21.7386 10.1626L13.0369 17.7828C12.7146 18.0964 12.1417 18.0964 11.7836 17.7828ZM13.4666 2.76193L10.6735 5.23929C10.4586 5.42744 10.1364 5.42744 9.9215 5.23929C9.70664 5.05113 9.70664 4.7689 9.9215 4.58075L11.712 3.01281L11.6762 2.98145C10.9242 2.35427 10.0647 1.88389 9.13369 1.66437C8.27426 1.47622 7.37903 1.47622 6.44799 1.72709C5.66018 1.9466 4.90819 2.35427 4.29943 2.88737C3.69067 3.38911 3.22515 4.04765 2.97448 4.73755C2.68801 5.52152 2.6522 6.27413 2.86705 6.96403C3.08191 7.71664 3.58324 8.43789 4.29943 9.06507L12.4282 16.1522L20.5211 9.06507L20.5569 9.03371C21.2731 8.40654 21.7744 7.71664 21.9893 6.93267C22.2041 6.24277 22.2041 5.49016 21.8818 4.70619C21.5953 4.01629 21.1298 3.38911 20.5569 2.85601C19.9481 2.32291 19.1961 1.91524 18.4083 1.69573C17.4773 1.44486 16.582 1.44486 15.7584 1.63301C14.9348 1.88389 14.147 2.26019 13.4666 2.76193Z" fill="#3597D0" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        <div>
            <div class="bg-white rounded-card p-3.5 border-2 border-white border-solid hover:border-2 shadow-card hover:border-gray-200 mx-3">
                <div class="flex justify-between items-center pb-3.5 px-2.5">
                    <h5 class="text-xl">2.650 MDL</h5>
                    <span class="text-sky-theme text-sm line-through">3.000 MDL</span>
                </div>
                <img class="object-cover w-full h-40" src="/assets/img/front/Rectangle_2.png" alt="">
                <div class="flex justify-between items-center text-sm text-gray-400 pt-3.5">
                    <h5 class="uppercase">GROHE</h5>
                    <span>Art. 28512001</span>
                </div>
                <h2 class="text-lg leading-6 text-gray-900 pt-2">Setul dușului igienic Grohe Bau Edge</h2>
                <div class="flex justify-between pt-7">
                    <a href="#" class="bg-sky-theme rounded-xl py-3 px-8 w-full mr-2.5 text-center text-white text-sm leading-normal">
                        <i class="fas fa-shopping-cart pr-2"></i>
                        В корзину
                    </a>
                    <a href="#" class="w-[50px] text-center border border-solid border-gray-300 rounded-xl px-3 py-2.5 text-sky-theme flex items-center">
                        <svg width="24" height="19" viewBox="0 0 24 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.7836 17.7828L3.0461 10.1313C2.11506 9.3473 1.47049 8.37518 1.18401 7.34033C0.897537 6.36821 0.897537 5.30201 1.29144 4.2358C1.64953 3.29504 2.25829 2.4797 3.0461 1.78981C3.86971 1.09991 4.83657 0.566812 5.91085 0.284582C7.16418 -0.0603659 8.4175 -0.0917247 9.5634 0.190505C10.6019 0.441376 11.5687 0.880401 12.4282 1.50758C13.2876 0.880401 14.2544 0.441376 15.2929 0.190505C16.4388 -0.0603659 17.6921 -0.0603659 18.9455 0.284582C20.0197 0.566812 20.9866 1.09991 21.8102 1.78981C22.598 2.4797 23.2426 3.29504 23.5649 4.2358C23.9588 5.30201 23.9946 6.36821 23.6723 7.34033C23.35 8.37518 22.7054 9.31594 21.7744 10.1313L21.7386 10.1626L13.0369 17.7828C12.7146 18.0964 12.1417 18.0964 11.7836 17.7828ZM13.4666 2.76193L10.6735 5.23929C10.4586 5.42744 10.1364 5.42744 9.9215 5.23929C9.70664 5.05113 9.70664 4.7689 9.9215 4.58075L11.712 3.01281L11.6762 2.98145C10.9242 2.35427 10.0647 1.88389 9.13369 1.66437C8.27426 1.47622 7.37903 1.47622 6.44799 1.72709C5.66018 1.9466 4.90819 2.35427 4.29943 2.88737C3.69067 3.38911 3.22515 4.04765 2.97448 4.73755C2.68801 5.52152 2.6522 6.27413 2.86705 6.96403C3.08191 7.71664 3.58324 8.43789 4.29943 9.06507L12.4282 16.1522L20.5211 9.06507L20.5569 9.03371C21.2731 8.40654 21.7744 7.71664 21.9893 6.93267C22.2041 6.24277 22.2041 5.49016 21.8818 4.70619C21.5953 4.01629 21.1298 3.38911 20.5569 2.85601C19.9481 2.32291 19.1961 1.91524 18.4083 1.69573C17.4773 1.44486 16.582 1.44486 15.7584 1.63301C14.9348 1.88389 14.147 2.26019 13.4666 2.76193Z" fill="#3597D0" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        <div>
            <div class="bg-white rounded-card p-3.5 border-2 border-white border-solid hover:border-2 shadow-card hover:border-gray-200 mx-3">
                <div class="flex justify-between items-center pb-3.5 px-2.5">
                    <h5 class="text-xl">2.650 MDL</h5>
                    <span class="text-sky-theme text-sm line-through">3.000 MDL</span>
                </div>
                <img class="object-cover w-full h-40" src="/assets/img/front/rectangleCart2.png" alt="">
                <div class="flex justify-between items-center text-sm text-gray-400 pt-3.5">
                    <h5 class="uppercase">GROHE</h5>
                    <span>Art. 28512001</span>
                </div>
                <h2 class="text-lg leading-6 text-gray-900 pt-2">Setul dușului igienic Grohe Bau Edge</h2>
                <div class="flex justify-between pt-7">
                    <a href="#" class="bg-sky-theme rounded-xl py-3 px-8 w-full mr-2.5 text-center text-white text-sm leading-normal">
                        <i class="fas fa-shopping-cart pr-2"></i>
                        В корзину
                    </a>
                    <a href="#" class="w-[50px] text-center border border-solid border-gray-300 rounded-xl px-3 py-2.5 text-sky-theme flex items-center">
                        <svg width="24" height="19" viewBox="0 0 24 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.7836 17.7828L3.0461 10.1313C2.11506 9.3473 1.47049 8.37518 1.18401 7.34033C0.897537 6.36821 0.897537 5.30201 1.29144 4.2358C1.64953 3.29504 2.25829 2.4797 3.0461 1.78981C3.86971 1.09991 4.83657 0.566812 5.91085 0.284582C7.16418 -0.0603659 8.4175 -0.0917247 9.5634 0.190505C10.6019 0.441376 11.5687 0.880401 12.4282 1.50758C13.2876 0.880401 14.2544 0.441376 15.2929 0.190505C16.4388 -0.0603659 17.6921 -0.0603659 18.9455 0.284582C20.0197 0.566812 20.9866 1.09991 21.8102 1.78981C22.598 2.4797 23.2426 3.29504 23.5649 4.2358C23.9588 5.30201 23.9946 6.36821 23.6723 7.34033C23.35 8.37518 22.7054 9.31594 21.7744 10.1313L21.7386 10.1626L13.0369 17.7828C12.7146 18.0964 12.1417 18.0964 11.7836 17.7828ZM13.4666 2.76193L10.6735 5.23929C10.4586 5.42744 10.1364 5.42744 9.9215 5.23929C9.70664 5.05113 9.70664 4.7689 9.9215 4.58075L11.712 3.01281L11.6762 2.98145C10.9242 2.35427 10.0647 1.88389 9.13369 1.66437C8.27426 1.47622 7.37903 1.47622 6.44799 1.72709C5.66018 1.9466 4.90819 2.35427 4.29943 2.88737C3.69067 3.38911 3.22515 4.04765 2.97448 4.73755C2.68801 5.52152 2.6522 6.27413 2.86705 6.96403C3.08191 7.71664 3.58324 8.43789 4.29943 9.06507L12.4282 16.1522L20.5211 9.06507L20.5569 9.03371C21.2731 8.40654 21.7744 7.71664 21.9893 6.93267C22.2041 6.24277 22.2041 5.49016 21.8818 4.70619C21.5953 4.01629 21.1298 3.38911 20.5569 2.85601C19.9481 2.32291 19.1961 1.91524 18.4083 1.69573C17.4773 1.44486 16.582 1.44486 15.7584 1.63301C14.9348 1.88389 14.147 2.26019 13.4666 2.76193Z" fill="#3597D0" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        <div>
            <div class="bg-white rounded-card p-3.5 border-2 border-white border-solid hover:border-2 shadow-card hover:border-gray-200 mx-3">
                <div class="flex justify-between items-center pb-3.5 px-2.5">
                    <h5 class="text-xl">2.650 MDL</h5>
                    <span class="text-sky-theme text-sm line-through">3.000 MDL</span>
                </div>
                <img class="object-cover w-full h-40" src="/assets/img/front/rectangleCart2.png" alt="">
                <div class="flex justify-between items-center text-sm text-gray-400 pt-3.5">
                    <h5 class="uppercase">GROHE</h5>
                    <span>Art. 28512001</span>
                </div>
                <h2 class="text-lg leading-6 text-gray-900 pt-2">Setul dușului igienic Grohe Bau Edge</h2>
                <div class="flex justify-between pt-7">
                    <a href="#" class="bg-sky-theme rounded-xl py-3 px-8 w-full mr-2.5 text-center text-white text-sm leading-normal">
                        <i class="fas fa-shopping-cart pr-2"></i>
                        В корзину
                    </a>
                    <a href="#" class="w-[50px] text-center border border-solid border-gray-300 rounded-xl px-3 py-2.5 text-sky-theme flex items-center">
                        <svg width="24" height="19" viewBox="0 0 24 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.7836 17.7828L3.0461 10.1313C2.11506 9.3473 1.47049 8.37518 1.18401 7.34033C0.897537 6.36821 0.897537 5.30201 1.29144 4.2358C1.64953 3.29504 2.25829 2.4797 3.0461 1.78981C3.86971 1.09991 4.83657 0.566812 5.91085 0.284582C7.16418 -0.0603659 8.4175 -0.0917247 9.5634 0.190505C10.6019 0.441376 11.5687 0.880401 12.4282 1.50758C13.2876 0.880401 14.2544 0.441376 15.2929 0.190505C16.4388 -0.0603659 17.6921 -0.0603659 18.9455 0.284582C20.0197 0.566812 20.9866 1.09991 21.8102 1.78981C22.598 2.4797 23.2426 3.29504 23.5649 4.2358C23.9588 5.30201 23.9946 6.36821 23.6723 7.34033C23.35 8.37518 22.7054 9.31594 21.7744 10.1313L21.7386 10.1626L13.0369 17.7828C12.7146 18.0964 12.1417 18.0964 11.7836 17.7828ZM13.4666 2.76193L10.6735 5.23929C10.4586 5.42744 10.1364 5.42744 9.9215 5.23929C9.70664 5.05113 9.70664 4.7689 9.9215 4.58075L11.712 3.01281L11.6762 2.98145C10.9242 2.35427 10.0647 1.88389 9.13369 1.66437C8.27426 1.47622 7.37903 1.47622 6.44799 1.72709C5.66018 1.9466 4.90819 2.35427 4.29943 2.88737C3.69067 3.38911 3.22515 4.04765 2.97448 4.73755C2.68801 5.52152 2.6522 6.27413 2.86705 6.96403C3.08191 7.71664 3.58324 8.43789 4.29943 9.06507L12.4282 16.1522L20.5211 9.06507L20.5569 9.03371C21.2731 8.40654 21.7744 7.71664 21.9893 6.93267C22.2041 6.24277 22.2041 5.49016 21.8818 4.70619C21.5953 4.01629 21.1298 3.38911 20.5569 2.85601C19.9481 2.32291 19.1961 1.91524 18.4083 1.69573C17.4773 1.44486 16.582 1.44486 15.7584 1.63301C14.9348 1.88389 14.147 2.26019 13.4666 2.76193Z" fill="#3597D0" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="grid gap-6 grid-cols-4 py-14">
    <div class="bg-gray-300 rounded-card flex justify-start items-center">
        <img class="rounded-full p-3.5 w-24" src="/public/i/null.png" alt="">
        <h2 class="pl-2">
            <span class="block text-lg">Инсталяции</span>
            <a href="#" class="underline text-sm">Перейти каталог</a>
        </h2>
    </div>
    <div class="bg-white border-2 border-solid border-gray-300 rounded-card flex justify-start items-center">
        <img class="rounded-full p-3.5 w-24" src="/public/i/null.png" alt="">
        <h2 class="pl-2">
            <span class="block text-lg">Для ванной</span>
            <a href="#" class="underline text-sm">Перейти каталог</a>
        </h2>
    </div>
    <div class="bg-[#2F2A2A] text-white rounded-card flex justify-start items-center">
        <img class="rounded-full p-3.5 w-24" src="/public/i/null.png" alt="">
        <h2 class="pl-2">
            <span class="block text-lg">Для туалета</span>
            <a href="#" class="underline text-sm">Перейти каталог</a>
        </h2>
    </div>
</div>

<div class="bg-gray-theme rounded-bg px-7 pb-16 pt-12">
    <div class="flex justify-center items-center text-center pb-16">
        <span class="text-4xl pr-0 sm:pr-8">Инсталяции</span>
        <a class="py-2.5 px-6 border border-sky-theme border-solid rounded-full text-sm" href="/<?= $lclang ?>/<?= $menu['all'][2]->uri ?>">
            <span class="pr-8">Перейти в каталог</span>
            <svg class="inline-block" width="30" height="9" viewBox="0 0 30 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M29.8536 4.85355C30.0488 4.65829 30.0488 4.34171 29.8536 4.14645L26.6716 0.964466C26.4763 0.769204 26.1597 0.769204 25.9645 0.964466C25.7692 1.15973 25.7692 1.47631 25.9645 1.67157L28.7929 4.5L25.9645 7.32843C25.7692 7.52369 25.7692 7.84027 25.9645 8.03553C26.1597 8.2308 26.4763 8.2308 26.6716 8.03553L29.8536 4.85355ZM0 5H29.5V4H0V5Z" fill="#303030" />
            </svg>
        </a>
    </div>

    <div class="home-product-slider">
        <div>
            <div class="bg-white rounded-card p-3.5 border-2 border-white border-solid hover:border-2 shadow-card hover:border-gray-200 mx-3">
                <div class="flex justify-between items-center pb-3.5 px-2.5">
                    <h5 class="text-xl">2.650 MDL</h5>
                    <span class="text-sky-theme text-sm line-through">3.000 MDL</span>
                </div>
                <img class="object-cover w-full h-40" src="/assets/img/front/rectangleCart2.png" alt="">
                <div class="flex justify-between items-center text-sm text-gray-400 pt-3.5">
                    <h5 class="uppercase">GROHE</h5>
                    <span>Art. 28512001</span>
                </div>
                <h2 class="text-lg leading-6 text-gray-900 pt-2">Setul dușului igienic Grohe Bau Edge</h2>
                <div class="flex justify-between pt-7">
                    <a href="#" class="bg-sky-theme rounded-xl py-3 px-8 w-full mr-2.5 text-center text-white text-sm leading-normal">
                        <i class="fas fa-shopping-cart pr-2"></i>
                        В корзину
                    </a>
                    <a href="#" class="w-[50px] text-center border border-solid border-gray-300 rounded-xl px-3 py-2.5 text-sky-theme flex items-center">
                        <svg width="24" height="19" viewBox="0 0 24 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.7836 17.7828L3.0461 10.1313C2.11506 9.3473 1.47049 8.37518 1.18401 7.34033C0.897537 6.36821 0.897537 5.30201 1.29144 4.2358C1.64953 3.29504 2.25829 2.4797 3.0461 1.78981C3.86971 1.09991 4.83657 0.566812 5.91085 0.284582C7.16418 -0.0603659 8.4175 -0.0917247 9.5634 0.190505C10.6019 0.441376 11.5687 0.880401 12.4282 1.50758C13.2876 0.880401 14.2544 0.441376 15.2929 0.190505C16.4388 -0.0603659 17.6921 -0.0603659 18.9455 0.284582C20.0197 0.566812 20.9866 1.09991 21.8102 1.78981C22.598 2.4797 23.2426 3.29504 23.5649 4.2358C23.9588 5.30201 23.9946 6.36821 23.6723 7.34033C23.35 8.37518 22.7054 9.31594 21.7744 10.1313L21.7386 10.1626L13.0369 17.7828C12.7146 18.0964 12.1417 18.0964 11.7836 17.7828ZM13.4666 2.76193L10.6735 5.23929C10.4586 5.42744 10.1364 5.42744 9.9215 5.23929C9.70664 5.05113 9.70664 4.7689 9.9215 4.58075L11.712 3.01281L11.6762 2.98145C10.9242 2.35427 10.0647 1.88389 9.13369 1.66437C8.27426 1.47622 7.37903 1.47622 6.44799 1.72709C5.66018 1.9466 4.90819 2.35427 4.29943 2.88737C3.69067 3.38911 3.22515 4.04765 2.97448 4.73755C2.68801 5.52152 2.6522 6.27413 2.86705 6.96403C3.08191 7.71664 3.58324 8.43789 4.29943 9.06507L12.4282 16.1522L20.5211 9.06507L20.5569 9.03371C21.2731 8.40654 21.7744 7.71664 21.9893 6.93267C22.2041 6.24277 22.2041 5.49016 21.8818 4.70619C21.5953 4.01629 21.1298 3.38911 20.5569 2.85601C19.9481 2.32291 19.1961 1.91524 18.4083 1.69573C17.4773 1.44486 16.582 1.44486 15.7584 1.63301C14.9348 1.88389 14.147 2.26019 13.4666 2.76193Z" fill="#3597D0" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="px-7 pt-16 pb-16">
    <div class="flex justify-center items-center text-center pb-16">
        <span class="text-4xl pr-0 sm:pr-8">Для ванной</span>
        <a class="py-2.5 px-6 border border-sky-theme border-solid rounded-full" href="#">Перейти в каталог
            <i class="fas fa-long-arrow-alt-right pl-8"></i>
        </a>
    </div>

    <div class="home-product-slider">
        <div>
            <div class="bg-white rounded-card p-3.5 border-2 border-white border-solid hover:border-2 shadow-card hover:border-gray-200 mx-3">
                <div class="flex justify-between items-center pb-3.5 px-2.5">
                    <h5 class="text-xl">2.650 MDL</h5>
                    <span class="text-sky-theme text-sm line-through">3.000 MDL</span>
                </div>
                <img class="object-cover w-full h-40" src="/assets/img/front/rectangleCart2.png" alt="">
                <div class="flex justify-between items-center text-sm text-gray-400 pt-3.5">
                    <h5 class="uppercase">GROHE</h5>
                    <span>Art. 28512001</span>
                </div>
                <h2 class="text-lg leading-6 text-gray-900 pt-2">Setul dușului igienic Grohe Bau Edge</h2>
                <div class="flex justify-between pt-7">
                    <a href="#" class="bg-sky-theme rounded-xl py-3 px-8 w-full mr-2.5 text-center text-white text-sm leading-normal">
                        <i class="fas fa-shopping-cart pr-2"></i>
                        В корзину
                    </a>
                    <a href="#" class="w-[50px] text-center border border-solid border-gray-300 rounded-xl px-3 py-2.5 text-sky-theme flex items-center">
                        <svg width="24" height="19" viewBox="0 0 24 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.7836 17.7828L3.0461 10.1313C2.11506 9.3473 1.47049 8.37518 1.18401 7.34033C0.897537 6.36821 0.897537 5.30201 1.29144 4.2358C1.64953 3.29504 2.25829 2.4797 3.0461 1.78981C3.86971 1.09991 4.83657 0.566812 5.91085 0.284582C7.16418 -0.0603659 8.4175 -0.0917247 9.5634 0.190505C10.6019 0.441376 11.5687 0.880401 12.4282 1.50758C13.2876 0.880401 14.2544 0.441376 15.2929 0.190505C16.4388 -0.0603659 17.6921 -0.0603659 18.9455 0.284582C20.0197 0.566812 20.9866 1.09991 21.8102 1.78981C22.598 2.4797 23.2426 3.29504 23.5649 4.2358C23.9588 5.30201 23.9946 6.36821 23.6723 7.34033C23.35 8.37518 22.7054 9.31594 21.7744 10.1313L21.7386 10.1626L13.0369 17.7828C12.7146 18.0964 12.1417 18.0964 11.7836 17.7828ZM13.4666 2.76193L10.6735 5.23929C10.4586 5.42744 10.1364 5.42744 9.9215 5.23929C9.70664 5.05113 9.70664 4.7689 9.9215 4.58075L11.712 3.01281L11.6762 2.98145C10.9242 2.35427 10.0647 1.88389 9.13369 1.66437C8.27426 1.47622 7.37903 1.47622 6.44799 1.72709C5.66018 1.9466 4.90819 2.35427 4.29943 2.88737C3.69067 3.38911 3.22515 4.04765 2.97448 4.73755C2.68801 5.52152 2.6522 6.27413 2.86705 6.96403C3.08191 7.71664 3.58324 8.43789 4.29943 9.06507L12.4282 16.1522L20.5211 9.06507L20.5569 9.03371C21.2731 8.40654 21.7744 7.71664 21.9893 6.93267C22.2041 6.24277 22.2041 5.49016 21.8818 4.70619C21.5953 4.01629 21.1298 3.38911 20.5569 2.85601C19.9481 2.32291 19.1961 1.91524 18.4083 1.69573C17.4773 1.44486 16.582 1.44486 15.7584 1.63301C14.9348 1.88389 14.147 2.26019 13.4666 2.76193Z" fill="#3597D0" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="bg-gray-theme rounded-bg px-7 pb-16 pt-12">
    <div class="flex justify-center items-center text-center pb-16">
        <span class="text-4xl pr-0 sm:pr-8">Для туалета</span>
        <a class="py-2.5 px-6 border border-sky-theme border-solid rounded-full" href="#">Перейти в каталог
            <i class="fas fa-long-arrow-alt-right pl-8"></i>
        </a>
    </div>

    <div class="home-product-slider">
        <div>
            <div class="bg-white rounded-card p-3.5 border-2 border-white border-solid hover:border-2 shadow-card hover:border-gray-200 mx-3">
                <div class="flex justify-between items-center pb-3.5 px-2.5">
                    <h5 class="text-xl">2.650 MDL</h5>
                    <span class="text-sky-theme text-sm line-through">3.000 MDL</span>
                </div>
                <img class="object-cover w-full h-40" src="/assets/img/front/rectangleCart2.png" alt="">
                <div class="flex justify-between items-center text-sm text-gray-400 pt-3.5">
                    <h5 class="uppercase">GROHE</h5>
                    <span>Art. 28512001</span>
                </div>
                <h2 class="text-lg leading-6 text-gray-900 pt-2">Setul dușului igienic Grohe Bau Edge</h2>
                <div class="flex justify-between pt-7">
                    <a href="#" class="bg-sky-theme rounded-xl py-3 px-8 w-full mr-2.5 text-center text-white text-sm leading-normal">
                        <i class="fas fa-shopping-cart pr-2"></i>
                        В корзину
                    </a>
                    <a href="#" class="w-[50px] text-center border border-solid border-gray-300 rounded-xl px-3 py-2.5 text-sky-theme flex items-center">
                        <svg width="24" height="19" viewBox="0 0 24 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.7836 17.7828L3.0461 10.1313C2.11506 9.3473 1.47049 8.37518 1.18401 7.34033C0.897537 6.36821 0.897537 5.30201 1.29144 4.2358C1.64953 3.29504 2.25829 2.4797 3.0461 1.78981C3.86971 1.09991 4.83657 0.566812 5.91085 0.284582C7.16418 -0.0603659 8.4175 -0.0917247 9.5634 0.190505C10.6019 0.441376 11.5687 0.880401 12.4282 1.50758C13.2876 0.880401 14.2544 0.441376 15.2929 0.190505C16.4388 -0.0603659 17.6921 -0.0603659 18.9455 0.284582C20.0197 0.566812 20.9866 1.09991 21.8102 1.78981C22.598 2.4797 23.2426 3.29504 23.5649 4.2358C23.9588 5.30201 23.9946 6.36821 23.6723 7.34033C23.35 8.37518 22.7054 9.31594 21.7744 10.1313L21.7386 10.1626L13.0369 17.7828C12.7146 18.0964 12.1417 18.0964 11.7836 17.7828ZM13.4666 2.76193L10.6735 5.23929C10.4586 5.42744 10.1364 5.42744 9.9215 5.23929C9.70664 5.05113 9.70664 4.7689 9.9215 4.58075L11.712 3.01281L11.6762 2.98145C10.9242 2.35427 10.0647 1.88389 9.13369 1.66437C8.27426 1.47622 7.37903 1.47622 6.44799 1.72709C5.66018 1.9466 4.90819 2.35427 4.29943 2.88737C3.69067 3.38911 3.22515 4.04765 2.97448 4.73755C2.68801 5.52152 2.6522 6.27413 2.86705 6.96403C3.08191 7.71664 3.58324 8.43789 4.29943 9.06507L12.4282 16.1522L20.5211 9.06507L20.5569 9.03371C21.2731 8.40654 21.7744 7.71664 21.9893 6.93267C22.2041 6.24277 22.2041 5.49016 21.8818 4.70619C21.5953 4.01629 21.1298 3.38911 20.5569 2.85601C19.9481 2.32291 19.1961 1.91524 18.4083 1.69573C17.4773 1.44486 16.582 1.44486 15.7584 1.63301C14.9348 1.88389 14.147 2.26019 13.4666 2.76193Z" fill="#3597D0" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view("layouts/footer/pre_footer"); ?>