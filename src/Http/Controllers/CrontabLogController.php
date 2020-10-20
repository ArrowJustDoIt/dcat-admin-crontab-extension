<?php

namespace Dcat\Admin\Extension\Crontab\Http\Controllers;

use Dcat\Admin\Extension\Crontab\Http\Models\CrontabLog;
use Dcat\Admin\Extension\Crontab\Http\Models\CrontabLogs;
use Dcat\Admin\Extension\Crontab\Http\Models\Crontabs;
use Illuminate\Routing\Controller;
use Dcat\Admin\Controllers\HasResourceActions;
use Dcat\Admin\Grid;
use Dcat\Admin\Form;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Show;

class CrontabLogController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        $content->breadcrumb(
            ['text' => '定时任务日志', 'url' => '/crontabLogs'],
            ['text' => '列表']
        );
        return $content
            ->header('列表')
            ->description('定时任务日志')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        $content->breadcrumb(
            ['text' => '定时任务日志', 'url' => '/crontabLogs'],
            ['text' => '详情']
        );
        return $content
            ->header('详情')
            ->description('定时任务日志')
            ->body($this->detail($id));
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new CrontabLogs());
        $grid->disableCreateButton();
        $grid->id('Id')->sortable();
        $grid->type('类型')->using(CrontabController::CRONTAB_TYPE)->label('default');
        $grid->column('title','任务标题');
        $grid->remark('执行结果');
        $grid->column('created_at','执行时间')->display(function () {
            return date("Y-m-d H:i:s",strtotime($this->created_at));
        })->sortable();
        $grid->status('状态')->sortable()->using(['0'=>'失败','1'=>'成功'])->dot([
            0 => 'danger',
            1 => 'success'
        ]);
        $grid->actions(function ($actions) {
            $actions->disableEdit();
        });
        $grid->filter(function($filter){
            $filter->disableIdFilter();
            $filter->equal('cid','任务标题')->select(Crontabs::select('id', 'title')->get()->pluck('title', 'id'));
            $filter->equal('type', '类型')->select(CrontabController::CRONTAB_TYPE);

        });
        return $grid;
    }


    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(CrontabLogs::findOrFail($id));

        $show->type('类型')->using(CrontabController::CRONTAB_TYPE)->label('default');
        $show->cid('任务ID');
        $show->title('任务标题');
        $show->created_at('执行时间');
        $show->status('状态')->using([0 => '失败',1 => '成功'])->label();
        $show->remark('执行结果');

        $show->panel()->tools(function ($tools) {
            $tools->disableEdit();
        });

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new CrontabLogs());
        return $form;
    }
}