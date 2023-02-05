/**
 * External dependencies.
 */
import { addFilter } from '@wordpress/hooks';

/**
 * The internal dependencies.
 */
import NotSupportedField from '../../components/not-supported-field';

addFilter('carbon-fields.footer_scripts.block', 'carbon-fields/blocks', () => ( props ) => <NotSupportedField type={ props.field.type } />);
