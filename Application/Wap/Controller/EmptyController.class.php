<?php

namespace Wap\Controller;

class EmptyController extends CommonController
{
	public function _empty()
	{
		$this->display('Empty/index');
	}
}
