<template>
    <div class="addTask">
        <input type="text" v-model="task.name"/>
        <button :class="[ task.name ? 'active' : 'inactive', 'addButton']" @click="addTask()">Add</button>
    </div>
</template>

<script>
export default {
    data: function () {
        return {
            task: {
                name: ''
            }
        }
    },
    methods: {
        addTask() {
            if (!this.task.name) {
                console.log('tes');

                return;
            }
            axios.post('http://takenlijst.test/task', {
                task: this.task
            })
            .then(response => {
                if ( response.status === 201 ) {
                    this.task.name = ''
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
.addTask {
    display: flex;
    justify-content: center;
    align-items: center;
}

input {
    background: #f7f7f7;
    border: 0;
    outline: none;
    padding: 5px;
    margin-right: 10px;
    width: 100%;
}

.addButton {
    font-size: 20px;
    border: 0;
    outline: none;
    background-color: white;
    cursor: pointer;
}

.active {
    color: #008600;
}

.inactive {
    color: #a0a0a0;
}
</style>
