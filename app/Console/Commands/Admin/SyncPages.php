<?php

namespace App\Console\Commands\Admin;

use App\Models\Menu;
use App\Models\Page;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class SyncPages extends Command
{
    protected $name = 'admin:sync-pages';

    protected $description = '同步页面配置到数据库';

    public function handle()
    {
        $this->info('正在同步[页面配置]到数据库...');

        try {
            $menus = Menu::select(['id', 'href'])->where('p_id', '<>', 0)->get()->keyBy('href')->toArray();
            $pages = collect(File::allFiles(resource_path('config')))->map(function (\Symfony\Component\Finder\SplFileInfo $file) use ($menus) {
                $content = json_decode($file->getContents(), true);
                $content['menu_id'] = $menus[$content['uri']]['id'] ?? 0;

                return $content;
            });

            $bar = $this->output->createProgressBar($pages->count());
            $bar->start();

            DB::transaction(function () use ($pages, $bar) {
                Page::where(['status' => 0])->delete();

                $pages->each(function ($page) use ($bar) {
                    Page::query()->updateOrCreate(['uri' => $page['uri']], $page);
                    $bar->advance();
                });

                $diff = Page::all()->filter(function ($item) use ($pages) {
                    foreach ($pages as $page) {
                        if ($item->uri === $page['uri']) {
                            return false;
                        }
                    }

                    return true;
                });

                Page::query()->whereKey($diff->pluck('id'))->update(['status' => 0]);
            });

            $bar->finish();
        } catch (\Throwable $exception) {
            $this->error("同步[页面配置]到数据库失败：" . $exception->getMessage());
            return self::FAILURE;
        }

        $this->newLine();
        $this->info('同步[页面配置]到数据库成功！');

        return self::SUCCESS;
    }
}