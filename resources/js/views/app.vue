<template>
    <div class="taskListContainer">
        <div class="heading">
            <h2 id="title">Task list</h2>
            <add-task-form
                v-on:reloadList="getTasks()"
            />
        </div>
        <list-view
            :tasks="tasks"
            v-on:reloadList="getTasks()"
        />
    </div>
</template>
<script>
import axios from 'axios';
import addTaskForm from './tasks/add-task-form';
import listView from './tasks/task-list';

export default {
    components: {
        addTaskForm,
        listView
    },
    data: function () {
        return {
            tasks: []
        }
    },
    methods: {
        getTasks() {
            axios.get('tasks')
                .then(response => {
                    this.tasks = response.data
                })
                .catch(error => {
                    console.log(error);
                })
        },

    },
    created() {
        this.getTasks();
    }
}
</script>

<style>
.taskListContainer {
    width: 350px;
    margin: auto;
}

.heading {
    background: white;
    padding: 10px;
}

#title {
    text-align: center;
}
</style>
