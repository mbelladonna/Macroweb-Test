<?php
class Controller_Asks extends Controller_Template {
	
	public function action_index()
	{
		$data['asks'] = Model_Ask::find('all');
		$this->template->title = "Asks";
		$this->template->content = View::factory('asks/index', $data);

	}
	
	public function action_view($id = null)
	{
		$data['ask'] = Model_Ask::find($id);
		
		$this->template->title = "Ask";
		$this->template->content = View::factory('asks/view', $data);

	}
	
	public function action_create($id = null)
	{
		if (Input::method() == 'POST')
		{
			$ask = Model_Ask::factory(array(
				'question_id' => Input::post('question_id'),
				'ask' => Input::post('ask'),
			));

            list($insert_id, $rows_affected) = DB::insert('asks')->set(array('question_id' => Input::post('question_id'),
                                                                             'ask' => Input::post('ask')
                                                                            ))->execute();
                                                                                  
			if ($insert_id)
			{
				Session::set_flash('notice', 'Added ask #' . $ask->id . '.');

				Response::redirect('answers/create/'. Input::post('question_id').'/'.$insert_id);
			}

			else
			{
				Session::set_flash('notice', 'Could not save ask.');
			}
		}
        
		$this->template->title = "Preguntas";
		$this->template->content = View::factory('asks/create', array('question_id' => $id));

	}
	
	public function action_edit($id = null)
	{
		$ask = Model_Ask::find($id);

		if (Input::method() == 'POST')
		{
			$ask->question_id = Input::post('question_id');
			$ask->ask = Input::post('ask');

			if ($ask->save())
			{
				Session::set_flash('notice', 'Updated ask #' . $id);

				Response::redirect('asks');
			}

			else
			{
				Session::set_flash('notice', 'Could not update ask #' . $id);
			}
		}
		
		else
		{
			$this->template->set_global('ask', $ask, false);
		}
		
		$this->template->title = "Asks";
		$this->template->content = View::factory('asks/edit');

	}
	
	public function action_delete($id = null)
	{
		if ($ask = Model_Ask::find($id))
		{
			$ask->delete();
			
			Session::set_flash('notice', 'Deleted ask #' . $id);
		}

		else
		{
			Session::set_flash('notice', 'Could not delete ask #' . $id);
		}

		Response::redirect('asks');

	}
	
	
}

/* End of file asks.php */
