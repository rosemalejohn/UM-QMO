export const getAllFiles = ({dispatch}) => {

	dispatch('GET_ALL_FILES', files)

}

export const deleteFile = ({dispatch}, file) => {

	dispatch('DELETE_FILE', file)

}

export const addFile = ({dispatch}, file) => {

	dispatch('ADD_FILE', file)

}
	
export const updateFile = ({dispatch}, file) => {

	dispatch('UPDATE_FILE', file)

} 