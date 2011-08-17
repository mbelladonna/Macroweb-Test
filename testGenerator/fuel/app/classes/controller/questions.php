<?php
class Controller_Questions extends Controller_Template {
	
	public function action_index()
	{
		$data['questions'] = Model_Question::find('all');
		$this->template->title = "Cuestionarios";
		$this->template->content = View::factory('questions/index', $data);

	}
	
	public function action_view($id = null)
	{
		$data['question'] = Model_Question::find($id);
		
		$this->template->title = "Question";
		$this->template->content = View::factory('questions/view', $data);

	}
	
	public function action_create($id = null)
	{
		if (Input::method() == 'POST')
		{
			$question = Model_Question::factory(array(
				'title' => Input::post('title'),
				'url' => Input::post('url'),
				'description' => Input::post('description'),
			));
            
            
            list($insert_id, $rows_affected) = DB::insert('questions')->set(array('title' => Input::post('title'),
                                                                                  'url' => Input::post('url'),
                                                                                  'description' => Input::post('description')
                                                                                  ))->execute();

			if ($insert_id)
			{
                Response::redirect('asks/create/'.$insert_id);
			}

			else
			{
				Session::set_flash('notice', 'Could not update question #' . $id);
			}
		}

		$this->template->title = "Cuestionarios";
		$this->template->content = View::factory('questions/create');

	}
	
	public function action_edit($id = null)
	{
		$question = Model_Question::find($id);

		if (Input::method() == 'POST')
		{
			$question->title = Input::post('title');
			$question->url = Input::post('url');
			$question->description = Input::post('description');

			if ($question->save())
			{
				Session::set_flash('notice', 'Updated question #' . $id);

				Response::redirect('questions');
			}

			else
			{
				Session::set_flash('notice', 'Could not update question #' . $id);
			}
		}
		
		else
		{
			$this->template->set_global('question', $question, false);
		}
		
		$this->template->title = "Questions";
		$this->template->content = View::factory('questions/edit');

	}
	
	public function action_delete($id = null)
	{
		if ($question = Model_Question::find($id))
		{
			$question->delete();
			
			Session::set_flash('notice', 'Deleted question #' . $id);
		}

		else
		{
			Session::set_flash('notice', 'Could not delete question #' . $id);
		}

		Response::redirect('questions');

	}
	
	
}

/* End of file questions.php */
