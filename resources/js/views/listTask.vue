<template>
    <div class="task">
        <input class="checkbox" type="checkbox" @change="updateCheck()" v-model="task.completed"/>
        <span :class="[ task.completed ? 'completed' : '', 'taskText' ]">{{ task.name }}</span>
        <button class="deleteButton" @click="removeTask()">Delete</button>
    </div>
</template>
<script>
import axios from 'axios';

export default {
    props: ['task'],
    methods: {
        updateCheck() {
            axios.patch('http://takenlijst.test/tasks/toggle/' + this.task.id, {
                completed: this.task.completed
            })
            .then(response => {
                if(response.status === 200) {
                    this.$emit('taskChanged');
                }
            })
            .catch(error => {
                console.log(error);
            })
        },
        removeTask() {
            axios.delete('http://takenlijst.test/tasks/' + this.task.id)
            .then(response => {
                if (response.status = 200) {
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

.completed {
    text-decoration: line-through;
    color: #999999
}

.taskText {
    width: 100%;
    margin-left: 20px;
}

.task {
    display: flex;
    justify-content: center;
    align-items: center;
}

.deleteButton {
    font-size: 15px;
    border: 0;
    outline: none;
    background-color: white;
    color: red;
    cursor: pointer;
}
</style>
