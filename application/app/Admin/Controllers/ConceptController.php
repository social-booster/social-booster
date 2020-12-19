<?php

namespace App\Admin\Controllers;

use App\Concept;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ConceptController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Concept';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Concept());

        $grid->model()->orderBy('start_rate', 'asc')->orderBy('additional_votes_ratio', 'desc');
        $grid->column('id', __('Id'))->hide();
        $grid->column('user_id', __('User id'))->hide();
        $grid->column('user.name');
        $grid->column('votes', __('Votes'))->sortable();
        $grid->column('additional_votes', __('Additional votes'))->sortable();
        $grid->column('additional_votes_ratio', __('Additional votes ratio'))->sortable();
        $grid->column('actions', __('Actions'))->sortable();
        $grid->column('actions_ratio', __('Actions ratio'))->sortable();
        $grid->column('start_rate', __('Start rate'))->sortable();
        $grid->column('layer', __('Layer'))->sortable();
        $grid->column('name', __('Name'))->limit(10);
        $grid->column('content', __('Content'))->limit(30);
        $grid->column('created_at', __('Created at'))->hide();
        $grid->column('updated_at', __('Updated at'))->hide();

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
        $show = new Show(Concept::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('user_id', __('User id'));
        $show->field('votes', __('Votes'));
        $show->field('additional_votes', __('Additional votes'));
        $show->field('additional_votes_ratio', __('Additional votes ratio'));
        $show->field('actions', __('Actions'));
        $show->field('actions_ratio', __('Actions ratio'));
        $show->field('start_rate', __('Start rate'));
        $show->field('layer', __('Layer'));
        $show->field('name', __('Name'));
        $show->field('content', __('Content'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Concept());

        $form->text('user_id', __('User id'));
        $form->number('votes', __('Votes'));
        $form->number('additional_votes', __('Additional votes'));
        $form->number('additional_votes_ratio', __('Additional votes ratio'));
        $form->number('actions', __('Actions'));
        $form->number('actions_ratio', __('Actions ratio'));
        $form->number('start_rate', __('Start rate'));
        $form->number('layer', __('Layer'));
        $form->text('name', __('Name'));
        $form->textarea('content', __('Content'));

        return $form;
    }
}
