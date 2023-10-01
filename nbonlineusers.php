<?php
	defined('_JEXEC') or die('Access deny');

	class plgContentnbonlineusers extends JPlugin 
	{
		function onContentPrepare($content, $article, $params, $limit){				
			/***************
			 * Je récupère le template html
			 ***************************/
			 $param = $this->params->get('template', '');
		
			/**************************
			  * client_Id = 1 means admin access
			  * client_Id = 0 means frontend access
			  *********************************************/
			$sql = "select session_id,client_id, guest, userid, mn8eb_users.username, mn8eb_users.name from mn8eb_session, mn8eb_users where(guest = 0) and mn8eb_session.userid=mn8eb_users.id";// and (client_id=0)";
			$db = JFactory::getDBO();
			$db->setQuery($sql);
			
			$nb=0;
			
			foreach($db->loadObjectList() as $A)
			{
				if ($A->client_id == 0)
				{
					$nb = $nb+1;
				}
			}
			
			$article->text = str_replace('{nbonline}', $nb, $param);
		}	
	}