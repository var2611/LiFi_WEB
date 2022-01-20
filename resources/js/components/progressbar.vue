<template>
    <div id="app">
        <a-modal
            title="Upload excel"
            v-model="visible"
            cancel-text="Close"
            ok-text="Confirm"
            :closable="false"
            :maskClosable="false"
            destroyOnClose
        >
            <a-upload-dragger
                name="file"
                :multiple="false"
                :showUploadList="false"
                :action="`/generate-user-from-salary-sheet`"
                @change="handleChange"
            >
                <p class="ant-upload-drag-icon">
                    <a-icon type="inbox"/>
                </p>
                <p class="ant-upload-text">Click to upload</p>
            </a-upload-dragger>
            <a-progress class="mt-5" :percent="progress" :show-info="true"/>
            <div class="text-right mt-1">{{ this.current_row }} / {{ this.total_rows }}</div>
            <template slot="footer">
                <Button @click="close">Close</Button>
            </template>
        </a-modal>
    </div>
</template>

<script>

// import {Button, Icon, Modal, Progress, Upload} from 'ant-design-vue';
// // import {  } from 'antd';
// Vue.use(Icon, Button, Progress, Modal);

export default {
    // components: {
    //     'a-modal': Modal,
    //     'a-progress': Progress,
    //     'a-upload-dragger': Upload,
    // },

    data() {
        this.trackProgress = _.debounce(this.trackProgress, 1000);

        return {
            visible: true,
            current_row: 0,
            total_rows: 0,
            progress: 0,
        };
    },

    methods: {
        handleChange(info) {
            const status = info.file.status;

            if (status === "done") {
                this.trackProgress();
            } else if (status === "error") {
                this.$message.error(_.get(info, 'file.response.errors.file.0', `${info.file.name} file upload failed.`));
            }
        },

        async trackProgress() {
            const {data} = await axios.get('/import-status');

            if (data.finished) {
                this.current_row = this.total_rows
                this.progress = 100
                return;
            }


            this.total_rows = data.total_rows;
            this.current_row = data.current_row;
            this.progress = Math.ceil(data.current_row / data.total_rows * 100);
            this.trackProgress();
        },

        close() {
            if (this.progress > 0 && this.progress < 100) {
                if (confirm('Do you want to close')) {
                    this.$emit('close')
                    window.location.reload()
                }
            } else {
                this.$emit('close')
                window.location.reload()
            }
        }
    },
};
</script>
