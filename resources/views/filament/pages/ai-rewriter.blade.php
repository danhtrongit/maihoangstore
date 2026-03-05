<x-filament-panels::page>
    <div x-data="aiRewriter()" x-init="loadStats(); loadJobs()">
        {{-- Stats Cards --}}
        <div style="display: grid; grid-template-columns: repeat(6, minmax(0, 1fr)); gap: 1rem;" class="mb-6">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-4 text-center">
                <div class="text-2xl font-bold text-gray-700 dark:text-gray-200" x-text="stats.total">0</div>
                <div class="text-xs text-gray-500 uppercase font-semibold">Tổng</div>
            </div>
            <div class="bg-yellow-50 dark:bg-yellow-900/20 rounded-xl shadow p-4 text-center">
                <div class="text-2xl font-bold text-yellow-600" x-text="stats.pending">0</div>
                <div class="text-xs text-gray-500 uppercase font-semibold">Chờ xử lý</div>
            </div>
            <div class="bg-blue-50 dark:bg-blue-900/20 rounded-xl shadow p-4 text-center">
                <div class="text-2xl font-bold text-blue-600" x-text="stats.crawled">0</div>
                <div class="text-xs text-gray-500 uppercase font-semibold">Đã crawl</div>
            </div>
            <div class="bg-purple-50 dark:bg-purple-900/20 rounded-xl shadow p-4 text-center">
                <div class="text-2xl font-bold text-purple-600" x-text="stats.rewriting">0</div>
                <div class="text-xs text-gray-500 uppercase font-semibold">Đang viết</div>
            </div>
            <div class="bg-green-50 dark:bg-green-900/20 rounded-xl shadow p-4 text-center">
                <div class="text-2xl font-bold text-green-600" x-text="stats.published">0</div>
                <div class="text-xs text-gray-500 uppercase font-semibold">Đã xuất bản</div>
            </div>
            <div class="bg-red-50 dark:bg-red-900/20 rounded-xl shadow p-4 text-center">
                <div class="text-2xl font-bold text-red-600" x-text="stats.failed">0</div>
                <div class="text-xs text-gray-500 uppercase font-semibold">Lỗi</div>
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="flex flex-wrap gap-3 mb-6">
            <button @click="fetchSitemap()" :disabled="loading || processing"
                class="px-6 py-2.5 bg-primary-600 hover:bg-primary-700 text-white rounded-lg font-semibold text-sm transition disabled:opacity-50 flex items-center gap-2">
                <svg x-show="!loading" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                <svg x-show="loading" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>
                Fetch Sitemap
            </button>

            <button @click="processBatch(5)" :disabled="processing"
                class="px-6 py-2.5 bg-success-600 hover:bg-success-700 text-white rounded-lg font-semibold text-sm transition disabled:opacity-50 flex items-center gap-2">
                <svg x-show="!processing" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <svg x-show="processing" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>
                Xử lý 5 bài
            </button>

            <button @click="processBatch(0)" :disabled="processing"
                class="px-6 py-2.5 bg-danger-600 hover:bg-danger-700 text-white rounded-lg font-semibold text-sm transition disabled:opacity-50 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                Xử lý TẤT CẢ
            </button>

            <button x-show="processing" @click="stopProcessing()"
                class="px-6 py-2.5 bg-gray-800 hover:bg-gray-900 text-white rounded-lg font-semibold text-sm transition flex items-center gap-2 animate-pulse">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><rect x="6" y="6" width="12" height="12" rx="1"/></svg>
                Dừng lại
            </button>

            <button @click="retryFailed()" :disabled="loading || processing"
                class="px-6 py-2.5 bg-warning-600 hover:bg-warning-700 text-white rounded-lg font-semibold text-sm transition disabled:opacity-50 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                Thử lại lỗi
            </button>

            <button @click="clearAll()" :disabled="processing"
                class="px-6 py-2.5 bg-gray-500 hover:bg-gray-600 text-white rounded-lg font-semibold text-sm transition disabled:opacity-50 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                Xóa tất cả
            </button>

            <div class="flex items-center gap-2 ml-auto">
                <label class="text-sm font-medium text-gray-600 dark:text-gray-400">Sitemap URL:</label>
                <input type="text" x-model="sitemapUrl" class="px-3 py-2 border rounded-lg text-sm w-80 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-200">
            </div>
        </div>

        {{-- Progress Bar --}}
        <div x-show="processing" class="mb-6">
            <div class="flex items-center justify-between mb-2">
                <div class="flex items-center gap-3">
                    <div class="w-3 h-3 rounded-full bg-blue-500 animate-pulse"></div>
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Đang xử lý...</span>
                </div>
                <span class="text-sm font-semibold text-primary-600" x-text="`${progressDone} / ${progressTotal > 0 ? progressTotal : '?'} bài`"></span>
            </div>
            <div x-show="progressTotal > 0" class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5 overflow-hidden">
                <div class="bg-gradient-to-r from-primary-500 to-success-500 h-full rounded-full transition-all duration-500"
                     :style="`width: ${Math.round(progressDone / progressTotal * 100)}%`"></div>
            </div>
        </div>

        {{-- Activity Log --}}
        <div x-show="logs.length > 0" class="mb-6">
            <div class="bg-gray-900 rounded-xl overflow-hidden shadow-lg">
                <div class="flex items-center justify-between px-4 py-2 bg-gray-800">
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 rounded-full" :class="processing ? 'bg-green-400 animate-pulse' : 'bg-gray-500'"></div>
                        <span class="text-gray-300 text-sm font-semibold">Nhật ký hoạt động</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-gray-500 text-xs" x-text="`${logs.length} sự kiện`"></span>
                        <button @click="logs = []" class="text-gray-500 hover:text-white text-xs px-2 py-1 rounded hover:bg-gray-700">Xóa</button>
                    </div>
                </div>
                <div class="p-4 max-h-60 overflow-y-auto font-mono text-sm space-y-1" x-ref="consoleLog">
                    <template x-for="(log, i) in logs" :key="i">
                        <div class="flex items-start gap-2">
                            <span class="text-gray-600 text-xs flex-shrink-0" x-text="log.time"></span>
                            <span :class="{
                                'text-green-400': log.type === 'success',
                                'text-red-400': log.type === 'error',
                                'text-yellow-300': log.type === 'warning',
                                'text-blue-300': log.type === 'info',
                                'text-gray-400': log.type === 'done',
                            }" x-text="log.message"></span>
                        </div>
                    </template>
                </div>
            </div>
        </div>

        {{-- Jobs Table --}}
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow overflow-hidden">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="font-bold text-gray-700 dark:text-gray-200">Danh sách bài viết</h3>
                <div class="flex items-center gap-2">
                    <select x-model="filterStatus" @change="loadJobs()" class="px-3 py-1.5 border rounded-lg text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
                        <option value="">Tất cả</option>
                        <option value="pending">Chờ xử lý</option>
                        <option value="crawled">Đã crawl</option>
                        <option value="rewriting">Đang viết</option>
                        <option value="rewritten">Đã viết lại</option>
                        <option value="published">Đã xuất bản</option>
                        <option value="failed">Lỗi</option>
                    </select>
                    <button @click="loadJobs()" class="p-2 text-gray-500 hover:text-gray-700 dark:hover:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                    </button>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 dark:bg-gray-900">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">ID</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">URL / Tiêu đề</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Trạng thái</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Bài viết mới</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Thời gian</th>
                            <th class="px-4 py-3 text-right text-xs font-semibold text-gray-500 uppercase">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        <template x-for="job in jobs" :key="job.id">
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                                <td class="px-4 py-3 text-gray-600 dark:text-gray-400" x-text="job.id"></td>
                                <td class="px-4 py-3 max-w-xs">
                                    <a :href="job.source_url" target="_blank" class="text-primary-600 hover:underline text-xs truncate block" x-text="job.source_title || job.source_url"></a>
                                    <span x-show="job.source_category" class="inline-block mt-1 px-2 py-0.5 bg-gray-100 dark:bg-gray-700 rounded text-[10px] text-gray-500" x-text="job.source_category"></span>
                                </td>
                                <td class="px-4 py-3">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold"
                                          :class="{
                                              'bg-yellow-100 text-yellow-700': job.status === 'pending',
                                              'bg-blue-100 text-blue-700': job.status === 'crawling' || job.status === 'crawled',
                                              'bg-purple-100 text-purple-700': job.status === 'rewriting',
                                              'bg-teal-100 text-teal-700': job.status === 'rewritten',
                                              'bg-green-100 text-green-700': job.status === 'published',
                                              'bg-red-100 text-red-700': job.status === 'failed',
                                          }"
                                          x-text="statusLabels[job.status] || job.status">
                                    </span>
                                    <div x-show="job.error_message" class="mt-1 text-[10px] text-red-500 truncate max-w-[200px]" x-text="job.error_message"></div>
                                </td>
                                <td class="px-4 py-3">
                                    <span x-show="job.rewritten_title" class="text-xs text-gray-700 dark:text-gray-300" x-text="(job.rewritten_title || '').substring(0, 60) + '...'"></span>
                                    <a x-show="job.post_id" :href="`/admin/posts/${job.post_id}/edit`" class="text-primary-600 hover:underline text-xs block mt-0.5">Xem bài viết</a>
                                </td>
                                <td class="px-4 py-3 text-xs text-gray-500" x-text="formatDate(job.updated_at)"></td>
                                <td class="px-4 py-3 text-right">
                                    <div class="flex items-center justify-end gap-1">
                                        <button x-show="job.status !== 'published'" @click="processSingle(job.id)"
                                            class="p-1.5 text-primary-600 hover:bg-primary-50 rounded" title="Xử lý">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/></svg>
                                        </button>
                                        <button @click="deleteJob(job.id)" class="p-1.5 text-red-600 hover:bg-red-50 rounded" title="Xóa">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </template>
                        <tr x-show="jobs.length === 0">
                            <td colspan="6" class="px-4 py-8 text-center text-gray-500">Chưa có bài viết nào. Nhấn "Fetch Sitemap" để bắt đầu.</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div x-show="pagination.last_page > 1" class="px-6 py-3 border-t border-gray-200 dark:border-gray-700 flex items-center justify-between">
                <span class="text-xs text-gray-500" x-text="`Trang ${pagination.current_page}/${pagination.last_page} (${pagination.total} bài)`"></span>
                <div class="flex gap-1">
                    <button @click="loadJobs(pagination.current_page - 1)" :disabled="pagination.current_page <= 1"
                        class="px-3 py-1 text-xs border rounded hover:bg-gray-50 disabled:opacity-30">&larr;</button>
                    <button @click="loadJobs(pagination.current_page + 1)" :disabled="pagination.current_page >= pagination.last_page"
                        class="px-3 py-1 text-xs border rounded hover:bg-gray-50 disabled:opacity-30">&rarr;</button>
                </div>
            </div>
        </div>
    </div>

    <script>
    function aiRewriter() {
        return {
            stats: { total: 0, pending: 0, crawled: 0, rewriting: 0, published: 0, failed: 0 },
            jobs: [],
            logs: [],
            loading: false,
            processing: false,
            shouldStop: false,
            filterStatus: '',
            sitemapUrl: 'https://delfi.com.vn/sitemap.xml',
            pagination: { current_page: 1, last_page: 1, total: 0 },
            progressDone: 0,
            progressTotal: 0,

            statusLabels: {
                'pending': 'Chờ xử lý',
                'crawling': 'Đang crawl',
                'crawled': 'Đã crawl',
                'rewriting': 'Đang viết',
                'rewritten': 'Đã viết lại',
                'published': 'Đã xuất bản',
                'failed': 'Lỗi',
            },

            addLog(type, message) {
                const time = new Date().toLocaleTimeString('vi-VN');
                this.logs.push({ type, message, time });
                if (this.logs.length > 200) this.logs = this.logs.slice(-100);
                this.$nextTick(() => {
                    const el = this.$refs.consoleLog;
                    if (el) el.scrollTop = el.scrollHeight;
                });
            },

            formatDate(dateStr) {
                if (!dateStr) return '';
                return new Date(dateStr).toLocaleString('vi-VN');
            },

            csrfToken() {
                return document.querySelector('meta[name="csrf-token"]')?.content || '';
            },

            async loadStats() {
                try {
                    const res = await fetch('/api/ai-rewriter/stats');
                    this.stats = await res.json();
                } catch(e) { console.error(e); }
            },

            async loadJobs(page = 1) {
                try {
                    let url = `/api/ai-rewriter/jobs?page=${page}`;
                    if (this.filterStatus) url += `&status=${this.filterStatus}`;
                    const res = await fetch(url);
                    const data = await res.json();
                    this.jobs = data.data || [];
                    this.pagination = {
                        current_page: data.current_page || 1,
                        last_page: data.last_page || 1,
                        total: data.total || 0,
                    };
                } catch(e) { console.error(e); }
            },

            async fetchSitemap() {
                this.loading = true;
                this.addLog('info', `Đang fetch sitemap: ${this.sitemapUrl}`);
                try {
                    const res = await fetch('/api/ai-rewriter/fetch-sitemap', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': this.csrfToken() },
                        body: JSON.stringify({ sitemap_url: this.sitemapUrl }),
                    });
                    const data = await res.json();
                    this.addLog('success', data.message);
                    await this.loadStats();
                    await this.loadJobs();
                } catch(e) {
                    this.addLog('error', `Lỗi: ${e.message}`);
                } finally {
                    this.loading = false;
                }
            },

            /**
             * Process jobs one by one via API calls from the browser.
             * limit=0 means process all, limit=N means process N jobs max.
             */
            async processBatch(limit) {
                this.processing = true;
                this.shouldStop = false;
                this.progressDone = 0;
                this.progressTotal = limit > 0 ? limit : this.stats.pending + this.stats.crawled + this.stats.failed;

                const label = limit > 0 ? `${limit} bài` : 'tất cả';
                this.addLog('info', `Bắt đầu xử lý ${label}...`);

                let processed = 0;
                let succeeded = 0;
                let failed = 0;

                while (true) {
                    if (this.shouldStop) {
                        this.addLog('warning', 'Đã dừng theo yêu cầu.');
                        break;
                    }
                    if (limit > 0 && processed >= limit) break;

                    try {
                        const res = await fetch('/api/ai-rewriter/process-next', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': this.csrfToken() },
                        });
                        const data = await res.json();

                        if (data.done) {
                            this.addLog('info', data.message);
                            break;
                        }

                        processed++;
                        this.progressDone = processed;

                        if (data.success) {
                            succeeded++;
                            this.addLog('success', `#${data.job_id} - ${data.title}`);
                        } else {
                            failed++;
                            this.addLog('error', `#${data.job_id} - ${data.error || 'Lỗi không xác định'}`);
                        }

                        await this.loadStats();
                        await this.loadJobs(this.pagination.current_page);
                    } catch(e) {
                        this.addLog('error', `Lỗi kết nối: ${e.message}`);
                        break;
                    }
                }

                this.addLog('done', `Hoàn tất! Thành công: ${succeeded}, Lỗi: ${failed}`);
                this.processing = false;
                await this.loadStats();
                await this.loadJobs();
            },

            stopProcessing() {
                this.shouldStop = true;
                this.addLog('warning', 'Đang dừng sau bài hiện tại...');
            },

            async processSingle(jobId) {
                this.addLog('info', `Đang xử lý job #${jobId}...`);
                try {
                    const res = await fetch(`/api/ai-rewriter/jobs/${jobId}/process`, {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': this.csrfToken() },
                    });
                    const data = await res.json();
                    if (data.success) {
                        this.addLog('success', `Job #${jobId} thành công!`);
                    } else {
                        this.addLog('error', data.error || 'Lỗi không xác định');
                    }
                    await this.loadStats();
                    await this.loadJobs();
                } catch(e) {
                    this.addLog('error', e.message);
                }
            },

            async deleteJob(jobId) {
                if (!confirm('Xóa job này?')) return;
                try {
                    await fetch(`/api/ai-rewriter/jobs/${jobId}`, {
                        method: 'DELETE',
                        headers: { 'X-CSRF-TOKEN': this.csrfToken() },
                    });
                    this.addLog('info', `Đã xóa job #${jobId}`);
                    await this.loadStats();
                    await this.loadJobs();
                } catch(e) {
                    this.addLog('error', e.message);
                }
            },

            async retryFailed() {
                this.loading = true;
                try {
                    const res = await fetch('/api/ai-rewriter/retry-failed', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': this.csrfToken() },
                    });
                    const data = await res.json();
                    this.addLog('success', data.message);
                    await this.loadStats();
                    await this.loadJobs();
                } catch(e) {
                    this.addLog('error', e.message);
                } finally {
                    this.loading = false;
                }
            },

            async clearAll() {
                if (!confirm('Xóa TẤT CẢ jobs? Không thể hoàn tác!')) return;
                this.loading = true;
                try {
                    const res = await fetch('/api/ai-rewriter/clear-all', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': this.csrfToken() },
                    });
                    const data = await res.json();
                    this.addLog('info', data.message);
                    await this.loadStats();
                    await this.loadJobs();
                } catch(e) {
                    this.addLog('error', e.message);
                } finally {
                    this.loading = false;
                }
            },
        }
    }
    </script>
</x-filament-panels::page>
