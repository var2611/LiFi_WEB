export default {
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
            const { data } = await axios.get('/import-status');

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
