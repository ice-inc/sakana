<script src="https://cdnjs.cloudflare.com/ajax/libs/babel-core/5.8.24/browser.min.js"></script>
<div id="message" align="center"></div>
<script type="text/babel">
  var Counter = React.createClass({
    getInitialState: function () {
      return { clickCount: 0 };
    },
    handleClick: function () {
      this.setState(function(state) {
        return {clickCount: state.clickCount + 1};
      });
    },
    render: function () {
      return (<h2 onClick={this.handleClick}>Click me! Number of clicks: {this.state.clickCount}</h2>);
    }
  });
  ReactDOM.render(
    <Counter />,
    document.getElementById('message')
    );
</script>
