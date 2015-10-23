<?php 
// 分类添加字段
function ems_add_category_field(){
	echo '<div class="form-field">
			<label for="cat-keywords">分类目录关键词</label>
			<input name="cat-keywords" id="cat-keywords" type="text" value="" size="40">
			<p>此处填写分类目录的关键词，多个以英文（,）号隔开。</p>
		  </div>';	
	echo '<div class="form-field">
			<label for="cat-description">分类目录描述</label>
			<textarea name="cat-description" id="cat-description" rows="5" cols="40"></textarea>
			<p>此处填写分类目录的描述，建议120字符以内。</p>
		  </div>';		  
		  
}
add_action('category_add_form_fields','ems_add_category_field',10,2);

// 分类编辑字段
function ems_edit_category_field($tag){
	echo '<tr class="form-field">
			<th scope="row"><label for="cat-keywords">分类目录关键词</label></th>
			<td>
				<input name="cat-keywords" id="cat-keywords" type="text" value="';
				echo get_option('cat-keywords-'.$tag->term_id).'" size="40"/><br>
				<span class="cat-keywords">编辑修改 '.$tag->name.' 的关键词多个以英文（,）逗号隔开。</span>
			</td>
		</tr>';
		
	echo '<tr class="form-field">
			<th scope="row"><label for="cat-description">分类目录描述</label></th>
			<td>
				<input name="cat-description" id="cat-description" type="text" value="';
				echo get_option('cat-description-'.$tag->term_id).'" size="40"/><br>
				<span class="cat-description">编辑修改 '.$tag->name.' 的目录描述，建议120字符以内。</span>
			</td>
		</tr>';	
		
		
}
add_action('category_edit_form_fields','ems_edit_category_field',10,2);

// 保存数据
function ems_taxonomy_metadate($term_id){
	if(isset($_POST['cat-keywords']) && isset($_POST['cat-description'])){
		//判断权限--可改
		if(!current_user_can('manage_categories')){
			return $term_id;
		}
		// 分类目录关键词
		$tel_key = 'cat-keywords-'.$term_id; // key 选项名为 cat-keywords-1 类型
		$tel_value = $_POST['cat-keywords'];	// value
		
		// 分类目录描述
		$url_key = 'cat-description-'.$term_id;
		$url_value = $_POST['cat-description'];	
			
		// 更新选项值
		update_option( $tel_key, $tel_value ); 
		update_option( $url_key, $url_value );
	}
}

// 虽然要两个钩子，但是我们可以两个钩子使用同一个函数
add_action('created_category','ems_taxonomy_metadate',10,1);
add_action('edited_category','ems_taxonomy_metadate',10,1);
?>