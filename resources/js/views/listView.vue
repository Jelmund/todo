<template>
    <div>
        <div v-for="task in tasks" :key=task.id>
            <list-task
                :task="task"
                class="task"
                v-on:taskChanged="$emit('reloadList')"
            />
        </div>
    </div>
</template>
<script>
import listTask from './listTask';

export default {
    props: ['tasks'],
    components: {
        listTask
    }
}
</script>

<style>
.task {
    background: white;
    padding: 5px;
    margin-top: 5px;
}
</style>
