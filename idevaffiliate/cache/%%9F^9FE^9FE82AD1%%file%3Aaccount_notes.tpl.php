<?php /* Smarty version 2.6.14, created on 2013-09-23 00:04:15
         compiled from file:account_notes.tpl */ ?>

<table border="0" cellspacing="0" width="100%" bgcolor="<?php echo $this->_tpl_vars['page_border']; ?>
" cellpadding="0" align="center">
<tr>
<td width="100%">
<table border="0" cellpadding="1" cellspacing="1" width="100%">
<tr>
<td width="100%" bgcolor="<?php echo $this->_tpl_vars['table_top']; ?>
">&nbsp;<b><font color="<?php echo $this->_tpl_vars['section_head_txt']; ?>
"><?php echo $this->_tpl_vars['general_notes_title']; ?>
</font></b></td>
</tr>

<?php unset($this->_sections['nr']);
$this->_sections['nr']['name'] = 'nr';
$this->_sections['nr']['loop'] = is_array($_loop=$this->_tpl_vars['note_results']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['nr']['show'] = true;
$this->_sections['nr']['max'] = $this->_sections['nr']['loop'];
$this->_sections['nr']['step'] = 1;
$this->_sections['nr']['start'] = $this->_sections['nr']['step'] > 0 ? 0 : $this->_sections['nr']['loop']-1;
if ($this->_sections['nr']['show']) {
    $this->_sections['nr']['total'] = $this->_sections['nr']['loop'];
    if ($this->_sections['nr']['total'] == 0)
        $this->_sections['nr']['show'] = false;
} else
    $this->_sections['nr']['total'] = 0;
if ($this->_sections['nr']['show']):

            for ($this->_sections['nr']['index'] = $this->_sections['nr']['start'], $this->_sections['nr']['iteration'] = 1;
                 $this->_sections['nr']['iteration'] <= $this->_sections['nr']['total'];
                 $this->_sections['nr']['index'] += $this->_sections['nr']['step'], $this->_sections['nr']['iteration']++):
$this->_sections['nr']['rownum'] = $this->_sections['nr']['iteration'];
$this->_sections['nr']['index_prev'] = $this->_sections['nr']['index'] - $this->_sections['nr']['step'];
$this->_sections['nr']['index_next'] = $this->_sections['nr']['index'] + $this->_sections['nr']['step'];
$this->_sections['nr']['first']      = ($this->_sections['nr']['iteration'] == 1);
$this->_sections['nr']['last']       = ($this->_sections['nr']['iteration'] == $this->_sections['nr']['total']);
?>

<tr><td width="100%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
" align="center">
<table border="0" cellpadding="0" cellspacing="0" width="95%">
<tr><td width="100%" colspan="2" height="5"></td></tr>
<tr>
<td width="50%"><?php echo $this->_tpl_vars['general_notes_date']; ?>
: <?php echo $this->_tpl_vars['note_results'][$this->_sections['nr']['index']]['note_date']; ?>
</td>
<td width="50%"><?php echo $this->_tpl_vars['general_notes_to']; ?>
: <?php echo $this->_tpl_vars['note_results'][$this->_sections['nr']['index']]['note_to']; ?>
</td>
</tr>
<tr><td width="100%" colspan="2" height="5"></td></tr>
<tr>
<td width="100%" colspan="2"><b><?php echo $this->_tpl_vars['note_results'][$this->_sections['nr']['index']]['note_subject']; ?>
</b></td>
</tr>
<tr>
<td width="100%" colspan="2"><?php echo $this->_tpl_vars['note_results'][$this->_sections['nr']['index']]['note_content']; ?>
</td>
</tr>
<tr><td width="100%" colspan="2" height="5"></td></tr>
</table>
</td></tr>

<?php endfor; else: ?>

<tr><td width="100%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
" align="center">
<table border="0" cellpadding="0" cellspacing="0" width="95%">
<tr><td width="100%" colspan="2" height="5"></td></tr>
<tr><td width="100%" bgcolor="<?php echo $this->_tpl_vars['lighter_cells']; ?>
"><?php echo $this->_tpl_vars['general_notes_none']; ?>
</td></tr>
<tr><td width="100%" colspan="2" height="5"></td></tr>
</table>
</td></tr>

<?php endif; ?>

</table>
</td>
</tr>
</table>

<br />
