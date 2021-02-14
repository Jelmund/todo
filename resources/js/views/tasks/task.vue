<template>
    <div class="task">
        <input class="checkbox" type="checkbox" @change="updateCheck()" v-model="task.completed"/>

        <template v-if="editing">
            <input v-model="task.name" :class="[ task.completed ? 'completed' : '', 'inputText' ]"/>
            <button class="button update" @click="saveTask()">Save</button>
        </template>

        <template v-else>
            <span :class="[ task.completed ? 'completed' : '', 'taskText' ]">{{ task.name }}</span>
            <button class="button update" @click="editing = true">Edit</button>
        </template>

        <button class="button delete" @click="removeTask()">Delete</button>
    </div>
</template>

<script>
import axios from 'axios'

export default {
    data: function () {
        return {
            editing: false
        }
    },
    props: ['task'],
    methods: {
        updateCheck() {
            axios.patch('tasks/toggle/' + this.task.id, {
                completed: this.task.completed
            })
                .then(response => {
                    if (response.status === 200) {
                        this.$emit('taskChanged');
                    }
                })
                .catch(error => {
                    console.log(error);
                })
        },
        saveTask() {
            axios.patch('tasks/' + this.task.id, {
                name: this.task.name
            })
                .then(response => {
                    if (response.status === 200) {
                        this.editing = false
                        this.$emit('taskChanged');
                    }
                })
                .catch(error => {
                    console.log(error);
                })
        },
        removeTask() {
            axios.delete('tasks/' + this.task.id)
                .then(response => {
                    if (response.status === 200) {
                        this.$emit('taskChanged');
                    }
                })
                .catch(error => {
                    console.log(error);
                })
        }
    }
}
</script>

<style>
.checkbox {
    width: 20px;
    margin: 5px;
}

.task {
    display: flex;
    justify-content: center;
    align-items: center;
}

.button {
    font-size: 15px;
    border: 0;
    outline: none;
    background-color: white;
    cursor: pointer;
}

.delete {
    color: red;
}

.update {
    color: cornflowerblue;
}

.completed {
    text-decoration: line-through;
    color: #999999
}

.taskText {
    width: 100%;
    margin-left: 20px;
}

.inputText {
    width: 100%;
    margin-left: 20px;
    padding: 0
}
</style>
