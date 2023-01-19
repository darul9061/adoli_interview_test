<template>
    <table class="border-collapse table-fixed">
        <thead>
          <tr class="text-slate-600 text-left">
            <th class="py-5 w-[200px]">Recordings</th>
            <th class="w-2/6">Title</th>
            <th class="">Views</th>
            <th class="">Size</th>
            <th class="">Last Modified</th>
            <th class=""> </th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="index, v in videos" :key="index" class="text-slate-600 text-left text-sm font-semibold">
            <td class="py-3">
                <div class="bg-gray-300 rounded-lg w-44 h-24 relative">
                    <p class="bg-black absolute text-white text-sm px-2 bottom-1 right-1">
                        00:14
                    </p>
                </div>
            </td>
            <td>
                <p>
                    Getting it right the first time
                </p>
                <div class="py-2"></div>
                <p class="text-xs font-semibold text-slate-400">
                    The video description is shown here.
                    <p>
                        If the user has added it
                    </p>
                </p>
            </td>
            <td>
                324
            </td>
            <td>
                934kb
            </td>
            <td>
                3 months ago
            </td>
            <td>
                <img src="../Assets/ellipsis.png" width="29" alt="up down" class="text-white-100">
            </td>
          </tr>
        </tbody>
      </table>

</template>
<script>
    export default {
        props: {
            videos: Array
        }
    }
</script>
