<div class="px-24 pb-8">
    <ul>
        <li class="inline-block"><a href="#">Prima pagină</a> /</li>
        <li class="inline-block"><a href="#">Magazinul</a> /</li>
        <li class="inline-block"><a href="#">WC</a> /</li>
        <li class="inline-block"><a href="#" class="text-sky-theme font-bold">Инсталяции</a></li>
    </ul>
    <h1 class="text-6xl">Setul dușului igienic Grohe Bau Edge</h1>
</div>

<div class="bg-gray-theme rounded-bg px-10 py-6">
    <div class="flex flex-row rounded-xl bg-white shadow-card px-24">
        <div class="basis-2/3 pt-16">
            <div x-data="{imageSrc: '/assets/img/front/rectangleCart2.png'}" class="flex items-start">
                <div class="flex flex-col justify-center gap-6 mt-16">
                    <img src="/assets/img/front/rectangleCart2.png" class="w-20"
                        @click="imageSrc = '/assets/img/front/rectangleCart2.png'">
                    <img src="/assets/img/front/Rectangle_2.png" class="w-20"
                        @click="imageSrc = '/assets/img/front/Rectangle_2.png'">
                </div>
                <div class="pl-8 pr-28 w-full">
                    <img :src="imageSrc" class="w-full object-cover">
                </div>
            </div>
        </div>
        <div class="basis-1/3 pt-20 pb-14">
            <div class="shadow-card rounded-xl py-8 px-7">
                <div class="flex justify-between">
                    <div>
                        <h5 class="pb-1.5">Цена:</h5>
                        <div class="flex items-start">
                            <span class="text-4xl leading-8 font-bold">2,650</span>
                            <span class="text-sm pl-1">MDL</span>
                        </div>
                        <h5 class="line-through text-zinc-500 text-lg pt-3">2,900 MDL</h5>
                    </div>
                    <div>
                        <img class="block ml-auto mb-4" src="/assets/img/front/discount.png" alt="">
                        <h5 class="text-right text-xs text-red-500">
                            Акционная цена действует при доставке до 24.06.2020
                        </h5>
                    </div>
                </div>
                <div class="flex justify-between pt-7">
                    <a href="#" class="bg-sky-theme rounded-xl py-3 px-14 text-white text-sm leading-normal">
                        <i class="fas fa-shopping-cart pr-2"></i>
                        Добавить в корзину
                    </a>
                    <a href="#"
                        class="w-[50px] text-center border border-solid border-gray-300 rounded-xl px-3 py-2.5 text-sky-theme">
                        <i class="far fa-heart text-xl leading-none"></i>
                    </a>
                </div>
            </div>

            <h2 class="text-lg pt-9 pb-1.5 border-b border-b-zinc-100 border-solid">
                <i class="fas fa-info-circle pr-2 pl-2 text-sky-theme"></i>
                Характеристики
            </h2>
            <ul class="pt-4">
                <li class="flex justify-between align-middle border-b border-solid border-zinc-100 py-1.5">
                    <span>Категория:</span>
                    <span class="font-bold">Унитазы</span>
                </li>
                <li class="flex justify-between align-middle border-b border-solid border-zinc-100 py-1.5">
                    <span>Бренд:</span>
                    <span class="font-bold">Ville</span>
                </li>
                <li class="flex justify-between align-middle border-b border-solid border-zinc-100 py-1.5">
                    <span>Cтрана производитель:</span>
                    <span class="font-bold">Испания</span>
                </li>
                <li class="flex justify-between align-middle border-b border-solid border-zinc-100 py-1.5">
                    <span>Тип установки:</span>
                    <span class="font-bold">Подвесной</span>
                </li>
                <li class="flex justify-between align-middle border-b border-solid border-zinc-100 py-1.5">
                    <span>Материал:</span>
                    <span class="font-bold">Керамика</span>
                </li>
                <li class="flex justify-between align-middle border-b border-solid border-zinc-100 py-1.5">
                    <span>Вид:</span>
                    <span class="font-bold">Подвесной под инсталяцию</span>
                </li>
            </ul>
        </div>
    </div>
</div>

<div x-data="{ tab: 'desc' }">
    <ul class="flex pt-8">
        <li @click="tab = 'desc'" x-bind:class="{ 'border-b-4 border-b-sky-theme': tab === 'desc' }"
            class=" flex-auto text-center border border-r-0 border-solid border-zinc-100 cursor-pointer py-2.5">
            Descriere</li>
        <li @click="tab = 'reviews'" x-bind:class="{ 'border-b-4 border-b-sky-theme': tab === 'reviews' }"
            class="flex-auto text-center border border-solid border-zinc-100 cursor-pointer py-2.5">Recenzii</li>
    </ul>

    <div x-show=" tab === 'desc'">
        <h2 class="text-lg pt-9 pb-1.5 border-b border-b-zinc-100 border-solid">
            <i class="far fa-file-alt pr-2 text-sky-theme"></i>
            Описание товара
        </h2>
        <p class="text-zinc-500 pt-3 pb-12">
            Тонкое быстросъёмное сиденье унитаза из антибактериального пластика Duroplast с функцией плавного опускания.
            Межосевое расстояние сидения 150 мм
            Изделие спроектировано в соответствии с концепцией VoClean: анатомичный дизайн, плавные формы и отсутствие
            острых углов - всё это обеспечивает эффективную эксплуатацию и облегчает очистку. Поверхность покрывается
            глазурью, на которую перед обжигом наносится специальное покрытие СeraPro
            Благодаря этому она становится максимально гладкой и менее подверженной загрязнению. Тонкое быстросъёмное
            сиденье унитаза из антибактериального пластика Duroplast с функцией плавного опускания. Межосевое расстояние
            сидения 150 мм Изделие спроектировано в соответствии с концепцией VoClean: анатомичный дизайн, плавные формы
            и отсутствие острых углов - всё это обеспечивает эффективную эксплуатацию и облегчает очистку. Поверхность
            покрывается глазурью, на которую перед обжигом наносится специальное покрытие СeraPro Благодаря этому она
            становится максимально гладкой и менее подверженной загрязнению. Тонкое быстросъёмное сиденье унитаза из
            антибактериального пластика Duroplast с функцией плавного опускания. Межосевое расстояние сидения 150 мм
            Изделие спроектировано в соответствии с концепцией VoClean: анатомичный дизайн, плавные формы и отсутствие
            острых углов - всё это обеспечивает эффективную эксплуатацию и облегчает очистку. Поверхность покрывается
            глазурью, на которую перед обжигом наносится специальное покрытие СeraPro
            Благодаря этому она становится максимально гладкой и менее подверженной загрязнению. Тонкое быстросъёмное
            сиденье унитаза из антибактериального пластика Duroplast с функцией плавного опускания. Межосевое расстояние
            сидения 150 мм Изделие спроектировано в соответствии с концепцией VoClean: анатомичный дизайн, плавные формы
            и отсутствие острых углов - всё это обеспечивает эффективную эксплуатацию и облегчает очистку. Поверхность
            покрывается глазурью, на которую перед обжигом наносится специальное покрытие СeraPro Благодаря этому она
            становится максимально гладкой и менее подверженной загрязнению.
        </p>
    </div>
    <div x-show="tab === 'reviews'">
        <h2 class="text-lg pt-9 pb-1.5 border-b border-b-zinc-100 border-solid">
            <i class="far fa-file-alt pr-2 text-sky-theme"></i>
            Recenzii
        </h2>
    </div>
</div>

<div class="bg-gray-theme rounded-bg px-7 pb-16 pt-12">
    <div class="text-center pb-16">
        <span class="text-4xl">Похожие товары</span>
    </div>

    <div class="grid gap-6 grid-cols-4">
        <div
            class="bg-white rounded-card p-3.5 border-2 border-white border-solid hover:border-2 shadow-card hover:border-gray-200">
            <div class="flex justify-between items-center pb-3.5 px-2.5">
                <h5 class="text-xl">2.650 MDL</h5>
                <span class="text-sky-theme text-sm line-through">3.000 MDL</span>
            </div>
            <img class="object-cover w-full" src="/assets/img/front/cdmd-logo.png" alt="">
            <div class="flex justify-between items-center text-sm text-gray-400 pt-3.5">
                <h5 class="uppercase">GROHE</h5>
                <span>Art. 28512001</span>
            </div>
            <h2 class="text-2xl leading-6 text-gray-900 pt-2">Setul dușului igienic Grohe Bau Edge</h2>
            <div class="flex justify-between pt-7">
                <a href="#" class="bg-sky-theme rounded-xl py-3 px-14 text-white text-sm leading-normal">
                    <i class="fas fa-shopping-cart pr-2"></i>
                    В корзину
                </a>
                <a href="#"
                    class="w-[50px] text-center border border-solid border-gray-300 rounded-xl p-3 text-sky-theme">
                    <i class="far fa-heart text-xl leading-none"></i>
                </a>
            </div>
        </div>
        <div
            class="bg-white rounded-card p-3.5 border-2 border-white border-solid hover:border-2 shadow-card hover:border-gray-200">
            <div class="flex justify-between items-center pb-3.5 px-2.5">
                <h5 class="text-xl">2.650 MDL</h5>
                <span class="text-sky-theme text-sm line-through">3.000 MDL</span>
            </div>
            <img class="object-cover w-full" src="/assets/img/front/cdmd-logo.png" alt="">
            <div class="flex justify-between items-center text-sm text-gray-400 pt-3.5">
                <h5 class="uppercase">GROHE</h5>
                <span>Art. 28512001</span>
            </div>
            <h2 class="text-2xl leading-6 text-gray-900 pt-2">Setul dușului igienic Grohe Bau Edge</h2>
            <div class="flex justify-between pt-7">
                <a href="#" class="bg-sky-theme rounded-xl py-3 px-14 text-white text-sm leading-normal">
                    <i class="fas fa-shopping-cart pr-2"></i>
                    В корзину
                </a>
                <a href="#"
                    class="w-[50px] text-center border border-solid border-gray-300 rounded-xl p-3 text-sky-theme">
                    <i class="far fa-heart text-xl leading-none"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view("layouts/footer/pre_footer"); ?>