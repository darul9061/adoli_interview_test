<script setup>
    import { Link } from '@inertiajs/vue3'
</script>

<template>
    <div class="relative flex h-16 bg-white border-b-2 border-gray-100 px-5 z-10">
        <div class="basis-1/6 p-2 flex justify-center items-center">
            <p class="">
                Logo
            </p>
        </div>
        <div class="basis-5/6 p-2 flex flex-row">
            <ul class=" font-medium text-base text-stone-800 basis-4/6 flex items-center justify-end space-x-[1.5%]">
                <Link href="/projects">
                    <li class="p-3">
                        Projects
                    </li>
                </Link>
                <Link href="/">
                    <li class="p-4">
                        Tools & App
                    </li>
                </Link>
                <li class="p-4">
                    Channels
                </li>
                <li class="p-4">
                    Contacts
                </li>
                <li class="p-4">
                    Analytics
                </li>
                <li class="p-4">
                    Settings
                </li>
            </ul>

            <div class="help basis-2/6 flex flex-row justify-center items-center space-x-5">
                <p class="font-medium text-lg text-slate-600">
                    Help
                </p>
                <div class="divider w-0.5 h-full bg-slate-400"></div>
                <div class="flex flex-row justify-center items-center overflow-x space-x-2">
                        <div  class="rounded bg-slate-900 w-10 h-10 px-2">
                            <img class="object-contain" src="../Assets/pexels-andrew-personal-training-697509.jpg" alt="Photo by Andrew Personal Training  from Pexels">
                        </div>
                        <div>
                            <p class="text-black font-medium text-base">
                                Cody Fisher
                            </p>
                            <p class="text-sm text-slate-400">
                                codyfisher@gmail.com
                            </p>
                        </div>

                </div>
            </div>
        </div>
    </div>
</template>
